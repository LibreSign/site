<?php

declare(strict_types=1);

namespace Tests\Unit\Listeners;

use App\Listeners\PushFooterFragments;
use App\Listeners\PushHeaderFragments;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

final class PushFragmentsTest extends TestCase
{
    private string $tempDir;

    protected function setUp(): void
    {
        parent::setUp();

        $this->tempDir = sys_get_temp_dir() . '/libresign-push-fragments-' . bin2hex(random_bytes(8));
        mkdir($this->tempDir, 0777, true);
    }

    protected function tearDown(): void
    {
        $this->deleteDirectory($this->tempDir);

        putenv('LIBRESIGN_PUBLISH_HEADER_FRAGMENTS');
        putenv('LIBRESIGN_PUBLISH_FOOTER_FRAGMENTS');

        parent::tearDown();
    }

    #[DataProvider('listenerProvider')]
    public function testShouldPublishDependsOnEnvironmentFlag(string $listenerClass, string $publishFlag): void
    {
        $listener = new $listenerClass();

        putenv($publishFlag . '=false');
        self::assertFalse($this->invokePrivateMethod($listener, 'shouldPublish'));

        putenv($publishFlag . '=true');
        self::assertTrue($this->invokePrivateMethod($listener, 'shouldPublish'));
    }

    #[DataProvider('listenerProvider')]
    public function testLoadManifestReturnsDecodedArrayAndEmptyArrayWhenMissing(string $listenerClass): void
    {
        $listener = new $listenerClass();
        $manifestPath = $this->tempDir . '/manifest.json';

        self::assertSame([], $this->invokePrivateMethod($listener, 'loadManifest', [$manifestPath]));

        file_put_contents($manifestPath, json_encode([
            'source/_assets/scss/example.scss' => ['file' => 'assets/example.css'],
        ], JSON_THROW_ON_ERROR));

        self::assertSame(
            ['source/_assets/scss/example.scss' => ['file' => 'assets/example.css']],
            $this->invokePrivateMethod($listener, 'loadManifest', [$manifestPath])
        );
    }

    #[DataProvider('listenerProvider')]
    public function testResolveBuildArtifactPathUsesManifestFile(string $listenerClass): void
    {
        $listener = new $listenerClass();
        $destinationPath = '/tmp/build';
        $manifest = [
            'source/_assets/scss/example.scss' => ['file' => 'assets/example-123.css'],
        ];

        self::assertSame(
            '/tmp/build/assets/build/assets/example-123.css',
            $this->invokePrivateMethod($listener, 'resolveBuildArtifactPath', [
                $destinationPath,
                $manifest,
                'source/_assets/scss/example.scss',
            ])
        );

        self::assertSame(
            '',
            $this->invokePrivateMethod($listener, 'resolveBuildArtifactPath', [
                $destinationPath,
                $manifest,
                'source/_assets/scss/missing.scss',
            ])
        );
    }

    #[DataProvider('fragmentStructureProvider')]
    public function testDiscoverFragmentFilesReturnsSortedMatchingFragmentFilesOnly(
        string $listenerClass,
        string $fragmentName,
        array $expectedRelativePaths
    ): void {
        $listener = new $listenerClass();
        $destinationPath = $this->tempDir . '/build';

        $this->writeFile($destinationPath . '/fragments/' . $fragmentName . '/index.html', '<div>default</div>');
        $this->writeFile($destinationPath . '/fragments/pt-BR/' . $fragmentName . '/index.html', '<div>pt-BR</div>');
        $this->writeFile($destinationPath . '/fragments/fr/' . $fragmentName . '/index.html', '<div>fr</div>');
        $this->writeFile($destinationPath . '/fragments/pt-BR/other/index.html', '<div>ignore</div>');
        $this->writeFile($destinationPath . '/fragments/' . ($fragmentName === 'header' ? 'footer' : 'header') . '/index.html', '<div>ignore sibling</div>');

        $files = $this->invokePrivateMethod($listener, 'discoverFragmentFiles', [$destinationPath]);
        $relativePaths = array_map(
            static fn (string $file): string => ltrim(str_replace(str_replace('\\', '/', $destinationPath), '', str_replace('\\', '/', $file)), '/'),
            $files
        );

        self::assertSame($expectedRelativePaths, $relativePaths);
    }

    #[DataProvider('listenerProvider')]
    public function testNormalizeAssetPathsFiltersAssetsAndRemovesDuplicates(string $listenerClass): void
    {
        $listener = new $listenerClass();

        $paths = $this->invokePrivateMethod($listener, 'normalizeAssetPaths', [[
            'http://localhost:8081/assets/images/logo.svg',
            '/assets/images/logo.svg',
            "'/assets/images/logo.svg'",
            '/assets/build/assets/header-fragment.css',
            '/not-assets/ignore.svg',
            'data:image/png;base64,abc',
            '',
        ]]);

        self::assertSame([
            'assets/images/logo.svg',
            'assets/build/assets/header-fragment.css',
        ], $paths);
    }

    #[DataProvider('listenerProvider')]
    public function testNormalizeStoredAssetPathRemovesLeadingAssetsDirectory(string $listenerClass): void
    {
        $listener = new $listenerClass();

        self::assertSame(
            'images/logo.svg',
            $this->invokePrivateMethod($listener, 'normalizeStoredAssetPath', ['assets/images/logo.svg'])
        );

        self::assertSame(
            'build/assets/file.woff2',
            $this->invokePrivateMethod($listener, 'normalizeStoredAssetPath', ['/assets/build/assets/file.woff2'])
        );
    }

    #[DataProvider('buildPayloadProvider')]
    public function testBuildPayloadStripsFragmentAttrsTokenizesAssetsAndExtractsLocale(
        string $listenerClass,
        string $assetBaseToken,
        string $fragmentName,
        string $locale,
        string $cssEntry,
        string $jsEntry
    ): void {
        $listener = new $listenerClass();
        $destinationPath = $this->tempDir . '/site-output';

        $fragmentPath = $destinationPath . '/fragments/' . $locale . '/' . $fragmentName . '/index.html';
        $cssArtifactPath = $destinationPath . '/assets/build/assets/' . basename($cssEntry);
        $jsArtifactPath = $destinationPath . '/assets/build/assets/' . basename($jsEntry);

        $logoPath = $destinationPath . '/assets/images/logo.svg';
        $fontPath = $destinationPath . '/assets/build/assets/font.woff2';

        $html = <<<HTML
<div class="fragment-root" data-fragment-css="http://localhost:8081/assets/build/assets/generated.css" data-fragment-js="http://localhost:8081/assets/build/assets/generated.js">
    <img src="http://localhost:8081/assets/images/logo.svg" alt="Logo">
    <img src="/assets/images/logo.svg" alt="Logo duplicate">
</div>
HTML;

        $css = <<<CSS
.fragment-root {
    background-image: url('/assets/images/logo.svg');
    src: url("/assets/build/assets/font.woff2") format('woff2');
}
CSS;

        $js = 'console.log("fragment");';

        $this->writeFile($fragmentPath, $html);
        $this->writeFile($cssArtifactPath, $css);
        $this->writeFile($jsArtifactPath, $js);
        $this->writeFile($logoPath, '<svg></svg>');
        $this->writeFile($fontPath, 'fake-font');

        $payload = $this->invokePrivateMethod($listener, 'buildPayload', [
            $fragmentPath,
            $destinationPath,
            $cssArtifactPath,
            $jsArtifactPath,
        ]);

        self::assertSame($locale, $payload['locale']);
        self::assertArrayHasKey('generated_at', $payload);
        self::assertSame(hash('sha256', $payload['html'] . "\n" . $payload['css'] . "\n" . $payload['js']), $payload['version']);

        self::assertStringNotContainsString('data-fragment-css=', $payload['html']);
        self::assertStringNotContainsString('data-fragment-js=', $payload['html']);
        self::assertStringContainsString($assetBaseToken . '/images/logo.svg', $payload['html']);
        self::assertStringContainsString($assetBaseToken . '/images/logo.svg', $payload['css']);
        self::assertStringContainsString($assetBaseToken . '/build/assets/font.woff2', $payload['css']);
        self::assertSame($js, $payload['js']);

        self::assertCount(2, $payload['assets']);
        self::assertSame([
            'path' => 'images/logo.svg',
            'content_base64' => base64_encode('<svg></svg>'),
            'mime' => mime_content_type($logoPath) ?: 'application/octet-stream',
        ], $payload['assets'][0]);
        self::assertSame('build/assets/font.woff2', $payload['assets'][1]['path']);
        self::assertSame(base64_encode('fake-font'), $payload['assets'][1]['content_base64']);
    }

    #[DataProvider('extractLocaleProvider')]
    public function testExtractLocaleFromFragmentPathReturnsExpectedValue(
        string $listenerClass,
        string $relativePath,
        string $expectedLocale
    ): void {
        $listener = new $listenerClass();

        self::assertSame(
            $expectedLocale,
            $this->invokePrivateMethod($listener, 'extractLocaleFromFragmentPath', [$relativePath])
        );
    }

    public static function listenerProvider(): iterable
    {
        yield 'header' => [PushHeaderFragments::class, 'LIBRESIGN_PUBLISH_HEADER_FRAGMENTS'];
        yield 'footer' => [PushFooterFragments::class, 'LIBRESIGN_PUBLISH_FOOTER_FRAGMENTS'];
    }

    public static function fragmentStructureProvider(): iterable
    {
        yield 'header fragments' => [
            PushHeaderFragments::class,
            'header',
            [
                'fragments/fr/header/index.html',
                'fragments/header/index.html',
                'fragments/pt-BR/header/index.html',
            ],
        ];

        yield 'footer fragments' => [
            PushFooterFragments::class,
            'footer',
            [
                'fragments/footer/index.html',
                'fragments/fr/footer/index.html',
                'fragments/pt-BR/footer/index.html',
            ],
        ];
    }

    public static function buildPayloadProvider(): iterable
    {
        yield 'header payload' => [
            PushHeaderFragments::class,
            '__LIBRESIGN_HEADER_ASSET_BASE_URL__',
            'header',
            'pt-BR',
            'header-fragment.css',
            'header-fragment.js',
        ];

        yield 'footer payload' => [
            PushFooterFragments::class,
            '__LIBRESIGN_FOOTER_ASSET_BASE_URL__',
            'footer',
            'pt',
            'footer-fragment.css',
            'footer-fragment.js',
        ];
    }

    public static function extractLocaleProvider(): iterable
    {
        yield 'header default locale' => [PushHeaderFragments::class, 'fragments/header/index.html', ''];
        yield 'header localized locale' => [PushHeaderFragments::class, 'fragments/pt-BR/header/index.html', 'pt-BR'];
        yield 'header ignores non header path' => [PushHeaderFragments::class, 'fragments/pt-BR/footer/index.html', ''];
        yield 'footer default locale' => [PushFooterFragments::class, 'fragments/footer/index.html', ''];
        yield 'footer localized locale' => [PushFooterFragments::class, 'fragments/fr/footer/index.html', 'fr'];
        yield 'footer ignores non footer path' => [PushFooterFragments::class, 'fragments/fr/header/index.html', ''];
    }

    /**
     * @param object $instance
     * @param array<int, mixed> $args
     */
    private function invokePrivateMethod(object $instance, string $method, array $args = []): mixed
    {
        $reflection = new ReflectionClass($instance);
        $methodReflection = $reflection->getMethod($method);
        $methodReflection->setAccessible(true);

        return $methodReflection->invokeArgs($instance, $args);
    }

    private function writeFile(string $path, string $contents): void
    {
        $directory = dirname($path);
        if (! is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        file_put_contents($path, $contents);
    }

    private function deleteDirectory(string $path): void
    {
        if (! is_dir($path)) {
            return;
        }

        $items = scandir($path);
        if ($items === false) {
            return;
        }

        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }

            $fullPath = $path . '/' . $item;
            if (is_dir($fullPath)) {
                $this->deleteDirectory($fullPath);
                continue;
            }

            unlink($fullPath);
        }

        rmdir($path);
    }
}
