<?php

declare(strict_types=1);

namespace Tests\Unit\Support\WordPress;

use App\Support\WordPress\WordPressBuildClient;
use PHPUnit\Framework\TestCase;

final class WordPressBuildClientTest extends TestCase
{
    public function testCreateStreamContextConfiguresTimeoutAndHeaders(): void
    {
        $client = new class(7) extends WordPressBuildClient
        {
            public function exposeCreateStreamContext(array $headers = [])
            {
                return $this->createStreamContext($headers);
            }
        };

        $context = $client->exposeCreateStreamContext([
            'Accept: application/json',
            'Authorization: Bearer token',
        ]);

        $options = stream_context_get_options($context);

        self::assertSame(7, $options['http']['timeout']);
        self::assertTrue($options['http']['ignore_errors']);
        self::assertSame(
            "Accept: application/json\r\nAuthorization: Bearer token",
            $options['http']['header']
        );
    }

    public function testFetchVersionReturnsNullWhenEndpointFails(): void
    {
        $client = new FakeWordPressBuildClient();

        self::assertNull($client->fetchVersion('https://account.example.test/'));
    }

    public function testFetchVersionReturnsVersionFromApiResponse(): void
    {
        $client = new FakeWordPressBuildClient([
            'https://account.example.test/wp-json/libresign/v1/version' => [
                'version' => '2.4.6',
            ],
        ]);

        self::assertSame('2.4.6', $client->fetchVersion('https://account.example.test/'));
    }

    public function testFetchLanguagesReturnsDecodedLanguages(): void
    {
        $client = new FakeWordPressBuildClient([
            'https://account.example.test/wp-json/pll/v1/languages' => [
                ['slug' => 'en', 'w3c' => 'en-US'],
                ['slug' => 'pt-br', 'w3c' => 'pt-BR'],
            ],
        ]);

        self::assertSame([
            ['slug' => 'en', 'w3c' => 'en-US'],
            ['slug' => 'pt-br', 'w3c' => 'pt-BR'],
        ], $client->fetchLanguages('https://account.example.test/'));
    }

    public function testFetchArticlePostsAggregatesPaginatedArticleCategories(): void
    {
        $accountUrl = 'https://account.example.test/';
        $categoriesUrl = 'https://account.example.test/wp-json/wp/v2/categories';
        $englishBaseUrl = 'https://account.example.test/wp-json/wp/v2/posts?_embed&categories=21&lang=en';
        $portugueseBaseUrl = 'https://account.example.test/wp-json/wp/v2/posts?_embed&categories=22&lang=pt-br';

        $client = new FakeWordPressBuildClient(
            [
                $categoriesUrl => [
                    ['id' => 20, 'slug' => 'news', 'lang' => 'en'],
                    ['id' => 21, 'slug' => 'article', 'lang' => 'en'],
                    ['id' => 22, 'slug' => 'article', 'lang' => 'pt-br'],
                ],
                $englishBaseUrl . '&page=1' => [
                    ['id' => 100, 'lang' => 'en'],
                ],
                $englishBaseUrl . '&page=2' => [
                    ['id' => 101, 'lang' => 'en'],
                ],
                $portugueseBaseUrl . '&page=1' => [
                    ['id' => 200, 'lang' => 'pt-br'],
                ],
            ],
            [
                $englishBaseUrl => ['X-WP-TotalPages' => '2'],
                $portugueseBaseUrl => ['X-WP-TotalPages' => '1'],
            ],
        );

        self::assertSame([
            ['id' => 100, 'lang' => 'en'],
            ['id' => 101, 'lang' => 'en'],
            ['id' => 200, 'lang' => 'pt-br'],
        ], $client->fetchArticlePosts($accountUrl));

        self::assertSame([
            $categoriesUrl,
            $englishBaseUrl . '&page=1',
            $englishBaseUrl . '&page=2',
            $portugueseBaseUrl . '&page=1',
        ], $client->requestedJsonUrls);
        self::assertSame([
            $englishBaseUrl,
            $portugueseBaseUrl,
        ], $client->requestedHeaderUrls);
    }

    public function testFetchArticlePostsDefaultsToSinglePageWhenHeadersAreMissing(): void
    {
        $accountUrl = 'https://account.example.test';
        $categoriesUrl = 'https://account.example.test/wp-json/wp/v2/categories';
        $baseUrl = 'https://account.example.test/wp-json/wp/v2/posts?_embed&categories=21&lang=en';

        $client = new FakeWordPressBuildClient([
            $categoriesUrl => [
                ['id' => 21, 'slug' => 'article', 'lang' => 'en'],
            ],
            $baseUrl . '&page=1' => [
                ['id' => 300, 'lang' => 'en'],
            ],
        ]);

        self::assertSame([
            ['id' => 300, 'lang' => 'en'],
        ], $client->fetchArticlePosts($accountUrl));
        self::assertSame([$baseUrl], $client->requestedHeaderUrls);
    }
}

final class FakeWordPressBuildClient extends WordPressBuildClient
{
    /**
     * @var list<string>
     */
    public array $requestedJsonUrls = [];

    /**
     * @var list<string>
     */
    public array $requestedHeaderUrls = [];

    /**
     * @param array<string, array<mixed>> $jsonResponses
     * @param array<string, array<string, mixed>> $headerResponses
     */
    public function __construct(
        private readonly array $jsonResponses = [],
        private readonly array $headerResponses = [],
    ) {
        parent::__construct();
    }

    protected function fetchJson(string $url): ?array
    {
        $this->requestedJsonUrls[] = $url;

        return $this->jsonResponses[$url] ?? null;
    }

    protected function fetchHeaders(string $url): array
    {
        $this->requestedHeaderUrls[] = $url;

        return $this->headerResponses[$url] ?? [];
    }
}
