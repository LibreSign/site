<?php

declare(strict_types=1);

namespace Tests\Unit\Support\Fragments;

use App\Support\Fragments\FragmentWebhookPublisher;
use PHPUnit\Framework\TestCase;

final class FragmentWebhookPublisherTest extends TestCase
{
    private string $tempDir;

    protected function setUp(): void
    {
        parent::setUp();

        $this->tempDir = sys_get_temp_dir() . '/libresign-fragment-webhook-' . bin2hex(random_bytes(8));
        mkdir($this->tempDir, 0777, true);
    }

    protected function tearDown(): void
    {
        $this->deleteDirectory($this->tempDir);

        parent::tearDown();
    }

    public function testBuildPayloadsReturnsEmptyArrayWhenManifestIsMissing(): void
    {
        $publisher = new FragmentWebhookPublisher();

        self::assertSame([], $publisher->buildPayloads('header', $this->tempDir));
    }

    public function testBuildPayloadsBuildsSortedHeaderPayloadsWithDeploymentMetadata(): void
    {
        $publisher = new FragmentWebhookPublisher();
        $destinationPath = $this->tempDir . '/site-output';

        $this->writeManifest($destinationPath, [
            'source/_assets/scss/header-fragment.scss' => ['file' => 'assets/header-fragment.css'],
            'source/_assets/js/header-fragment.js' => ['file' => 'assets/header-fragment.js'],
        ]);

        $this->writeFile(
            $destinationPath . '/fragments/header/index.html',
            $this->fragmentHtml('http://localhost:8081/assets/images/logo.svg')
        );
        $this->writeFile(
            $destinationPath . '/fragments/fr/header/index.html',
            $this->fragmentHtml('/assets/images/logo.svg')
        );
        $this->writeFile(
            $destinationPath . '/fragments/pt-BR/header/index.html',
            $this->fragmentHtml('https://libresign.coop/assets/images/logo.svg')
        );
        $this->writeFile(
            $destinationPath . '/fragments/pt-BR/footer/index.html',
            '<div>ignore</div>'
        );

        $this->writeFile(
            $destinationPath . '/assets/build/assets/header-fragment.css',
            ".fragment-root { background-image: url('/assets/images/logo.svg'); src: url(\"/assets/build/assets/font.woff2\") format('woff2'); }"
        );
        $this->writeFile(
            $destinationPath . '/assets/build/assets/header-fragment.js',
            'console.log("header");'
        );
        $this->writeFile($destinationPath . '/assets/images/logo.svg', '<svg></svg>');
        $this->writeFile($destinationPath . '/assets/build/assets/font.woff2', 'fake-font');

        $deployment = [
            'source' => 'github-actions',
            'repository' => 'LibreSign/site',
            'ref' => 'refs/heads/main',
            'event' => 'push',
            'sha' => 'abc123',
            'environment' => 'production',
        ];

        $payloads = $publisher->buildPayloads('header', $destinationPath, $deployment);

        self::assertCount(3, $payloads);
        self::assertSame(['fr', '', 'pt-BR'], array_column($payloads, 'locale'));

        $firstPayload = $payloads[0];
        self::assertSame('header', $firstPayload['fragment_type']);
        self::assertSame($deployment, $firstPayload['deployment']);
        self::assertStringNotContainsString('data-fragment-css=', $firstPayload['html']);
        self::assertStringNotContainsString('data-fragment-js=', $firstPayload['html']);
        self::assertStringContainsString('__LIBRESIGN_HEADER_ASSET_BASE_URL__/images/logo.svg', $firstPayload['html']);
        self::assertStringContainsString('__LIBRESIGN_HEADER_ASSET_BASE_URL__/images/logo.svg', $firstPayload['css']);
        self::assertStringContainsString('__LIBRESIGN_HEADER_ASSET_BASE_URL__/build/assets/font.woff2', $firstPayload['css']);
        self::assertSame('console.log("header");', $firstPayload['js']);
        self::assertArrayHasKey('generated_at', $firstPayload);
        self::assertSame(
            hash('sha256', $firstPayload['html'] . "\n" . $firstPayload['css'] . "\n" . $firstPayload['js']),
            $firstPayload['version']
        );

        self::assertCount(2, $firstPayload['assets']);
        self::assertSame('images/logo.svg', $firstPayload['assets'][0]['path']);
        self::assertSame(base64_encode('<svg></svg>'), $firstPayload['assets'][0]['content_base64']);
        self::assertSame('build/assets/font.woff2', $firstPayload['assets'][1]['path']);
    }

    public function testPublishDispatchesOneWebhookPerFooterFragment(): void
    {
        $publisher = new RecordingFragmentWebhookPublisher();
        $destinationPath = $this->tempDir . '/site-output';

        $this->writeManifest($destinationPath, [
            'source/_assets/scss/footer-fragment.scss' => ['file' => 'assets/footer-fragment.css'],
            'source/_assets/js/footer-fragment.js' => ['file' => 'assets/footer-fragment.js'],
        ]);

        $this->writeFile(
            $destinationPath . '/fragments/footer/index.html',
            $this->fragmentHtml('/assets/images/logo.svg')
        );
        $this->writeFile(
            $destinationPath . '/fragments/pt/footer/index.html',
            $this->fragmentHtml('/assets/images/logo.svg')
        );
        $this->writeFile(
            $destinationPath . '/assets/build/assets/footer-fragment.css',
            ".fragment-root { background-image: url('/assets/images/logo.svg'); }"
        );
        $this->writeFile(
            $destinationPath . '/assets/build/assets/footer-fragment.js',
            'console.log("footer");'
        );
        $this->writeFile($destinationPath . '/assets/images/logo.svg', '<svg></svg>');

        $count = $publisher->publish(
            'footer',
            $destinationPath,
            'https://example.test/footer-webhook',
            'super-secret',
            ['repository' => 'LibreSign/site', 'ref' => 'refs/heads/main']
        );

        self::assertSame(2, $count);
        self::assertCount(2, $publisher->dispatches);
        self::assertSame('https://example.test/footer-webhook', $publisher->dispatches[0]['webhookUrl']);
        self::assertSame('super-secret', $publisher->dispatches[0]['secret']);
        self::assertSame('footer', $publisher->dispatches[0]['payload']['fragment_type']);
        self::assertCount(1, $publisher->dispatches[0]['payload']['assets']);
        self::assertSame('images/logo.svg', $publisher->dispatches[0]['payload']['assets'][0]['path']);
        self::assertSame('pt', $publisher->dispatches[1]['payload']['locale']);
    }

    private function fragmentHtml(string $assetUrl): string
    {
        return <<<HTML
<div class="fragment-root" data-fragment-css="http://localhost:8081/assets/build/assets/generated.css" data-fragment-js="http://localhost:8081/assets/build/assets/generated.js">
    <img src="{$assetUrl}" alt="Logo">
</div>
HTML;
    }

    /**
     * @param array<string, array<string, string>> $manifest
     */
    private function writeManifest(string $destinationPath, array $manifest): void
    {
        $this->writeFile(
            $destinationPath . '/assets/build/manifest.json',
            json_encode($manifest, JSON_THROW_ON_ERROR)
        );
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

final class RecordingFragmentWebhookPublisher extends FragmentWebhookPublisher
{
    /**
     * @var list<array{webhookUrl: string, secret: string, payload: array<string, mixed>}>
     */
    public array $dispatches = [];

    protected function dispatch(string $webhookUrl, string $secret, array $payload): void
    {
        $this->dispatches[] = [
            'webhookUrl' => $webhookUrl,
            'secret' => $secret,
            'payload' => $payload,
        ];
    }
}
