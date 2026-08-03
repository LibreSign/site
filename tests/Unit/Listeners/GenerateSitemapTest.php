<?php

declare(strict_types=1);

namespace Tests\Unit\Listeners;

use App\Listeners\GenerateSitemap;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use TightenCo\Jigsaw\Jigsaw;

final class GenerateSitemapTest extends TestCase
{
    #[DataProvider('handleProvider')]
    public function testHandleGeneratesExpectedSitemap(
        array $pages,
        array $collections,
        array $expectedFragments,
        array $unexpectedFragments = [],
    ): void
    {
        $listener = new GenerateSitemap();
        $jigsaw = $this->createStub(Jigsaw::class);
        \org\bovigo\vfs\vfsStream::setup('build');

        $destinationPath = \org\bovigo\vfs\vfsStream::url('build');

        $jigsaw->method('getDestinationPath')->willReturn($destinationPath);
        $jigsaw->method('getPages')->willReturn(new FakePageCollection($pages));
        $jigsaw->method('getCollection')->willReturnCallback(
            static fn (string $collectionName) => $collections[$collectionName] ?? null,
        );

        $listener->handle($jigsaw);

        $xml = file_get_contents($destinationPath . '/sitemap.xml');

        self::assertIsString($xml);

        foreach ($expectedFragments as $fragment) {
            self::assertStringContainsString($fragment, $xml);
        }

        foreach ($unexpectedFragments as $fragment) {
            self::assertStringNotContainsString($fragment, $xml);
        }
    }

    public static function handleProvider(): iterable
    {
        yield 'collects images from page metadata' => [
            [
                '/posts/advanced-security' => (object) ['page' => (object) []],
                '/posts/libresign-api-guide' => (object) ['page' => (object) []],
                '/posts/free-and-open-source-software-for-electronic-signatures' => (object) ['page' => (object) []],
                '/assets/build/assets/main.js' => (object) [
                    'page' => (object) [
                        'banner' => '/assets/images/posts/should-not-appear/banner.jpg',
                    ],
                ],
                '/' => (object) [
                    'page' => (object) [],
                ],
            ],
            [
                'posts' => [
                    new FakeCollectionItem('/posts/advanced-security', [
                        'banner' => '/assets/images/posts/advanced-security/banner.jpg',
                        'cover_image' => '/assets/images/posts/advanced-security/cover.jpg',
                    ]),
                    new FakeCollectionItem('/posts/libresign-api-guide', [
                        'banner' => 'https://cdn.example.com/libresign-api-guide/banner.webp',
                        'cover_image' => 'https://cdn.example.com/libresign-api-guide/banner.webp',
                    ]),
                    new FakeCollectionItem('/posts/free-and-open-source-software-for-electronic-signatures', [
                        'banner' => '/assets/images/logo/logo.svg',
                        'cover_image' => '/assets/images/logo/logo.svg',
                    ]),
                ],
            ],
            [
                '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">',
                '<loc>https://libresign.coop/posts/advanced-security</loc>',
                '<image:loc>https://libresign.coop/assets/images/posts/advanced-security/banner.jpg</image:loc>',
                '<loc>https://libresign.coop/posts/libresign-api-guide</loc>',
                '<image:loc>https://cdn.example.com/libresign-api-guide/banner.webp</image:loc>',
                '<loc>https://libresign.coop/posts/free-and-open-source-software-for-electronic-signatures</loc>',
                '<loc>https://libresign.coop/</loc>',
            ],
            [
                '<loc>https://libresign.coop/assets/build/assets/main.js</loc>',
                '<image:loc>https://libresign.coop/assets/images/logo/logo.svg</image:loc>',
                '<image:loc>https://libresign.coop/assets/images/posts/advanced-security/cover.jpg</image:loc>',
            ],
        ];

        yield 'uses posts_wordpress collection too' => [
            [
                '/posts/libresign-api-guide' => (object) [
                    'page' => (object) [],
                ],
            ],
            [
                'posts_wordpress' => [
                    new FakeCollectionItem('/posts/libresign-api-guide', [
                        'banner' => 'https://cdn.example.com/libresign-api-guide/banner.webp',
                    ]),
                ],
            ],
            [
                '<loc>https://libresign.coop/posts/libresign-api-guide</loc>',
                '<image:loc>https://cdn.example.com/libresign-api-guide/banner.webp</image:loc>',
            ],
        ];
    }

}

final class FakeCollectionItem
{
    public function __construct(
        private string $url,
        private array $attributes,
    ) {
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function __get(string $name): mixed
    {
        return $this->attributes[$name] ?? null;
    }
}

final class FakePageCollection
{
    /**
     * @param array<string, object> $items
     */
    public function __construct(private array $items)
    {
    }

    public function map(callable $callback): self
    {
        $mapped = [];

        foreach ($this->items as $key => $value) {
            $mapped[$key] = $callback($value, $key);
        }

        return new self($mapped);
    }

    public function filter(callable $callback): self
    {
        $filtered = [];

        foreach ($this->items as $key => $value) {
            if ($callback($value, $key)) {
                $filtered[$key] = $value;
            }
        }

        return new self($filtered);
    }

    public function values(): self
    {
        return new self(array_values($this->items));
    }

    public function each(callable $callback): self
    {
        foreach ($this->items as $key => $value) {
            $callback($value, $key);
        }

        return $this;
    }
}
