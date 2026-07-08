<?php

declare(strict_types=1);

namespace App\Support\WordPress;

class WordPressBuildClient
{
    public function __construct(
        private readonly int $timeout = 15,
    ) {
    }

    public function fetchVersion(string $accountUrl): ?string
    {
        $response = $this->fetchJson($this->buildUrl($accountUrl, '/wp-json/libresign/v1/version'));
        $version = $response['version'] ?? null;

        if (! is_scalar($version) || $version === '') {
            return null;
        }

        return (string) $version;
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function fetchLanguages(string $accountUrl): array
    {
        $languages = $this->fetchJson($this->buildUrl($accountUrl, '/wp-json/pll/v1/languages'));

        return is_array($languages) ? array_values($languages) : [];
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function fetchArticlePosts(string $accountUrl): array
    {
        $categories = $this->fetchJson($this->buildUrl($accountUrl, '/wp-json/wp/v2/categories'));
        if (! is_array($categories)) {
            return [];
        }

        $posts = [];

        foreach ($categories as $category) {
            if (! is_array($category) || ($category['slug'] ?? null) !== 'article') {
                continue;
            }

            $categoryId = $category['id'] ?? null;
            $categoryLang = $category['lang'] ?? null;
            if (! is_scalar($categoryId) || ! is_scalar($categoryLang) || $categoryLang === '') {
                continue;
            }

            $baseUrl = $this->buildUrl(
                $accountUrl,
                '/wp-json/wp/v2/posts?_embed&categories=' . rawurlencode((string) $categoryId)
                . '&lang=' . rawurlencode((string) $categoryLang)
            );

            $totalPages = $this->extractTotalPages($this->fetchHeaders($baseUrl));
            $page = 1;

            while ($page <= $totalPages) {
                $response = $this->fetchJson($baseUrl . '&page=' . $page);
                if (! is_array($response)) {
                    break;
                }

                foreach ($response as $post) {
                    if (is_array($post)) {
                        $posts[] = $post;
                    }
                }

                $page++;
            }
        }

        return $posts;
    }

    protected function fetchJson(string $url): ?array
    {
        $response = $this->fetchContent($url);

        return $response ? (json_decode($response, true) ?: null) : null;
    }

    /**
     * @return array<string, mixed>
     */
    protected function fetchHeaders(string $url): array
    {
        $headers = @get_headers($url, true, $this->createStreamContext());

        return is_array($headers) ? $headers : [];
    }

    protected function fetchContent(string $url): string|false
    {
        return @file_get_contents($url, false, $this->createStreamContext());
    }

    protected function createStreamContext(array $headers = [])
    {
        $contextOptions = [
            'http' => [
                'timeout' => $this->timeout,
                'ignore_errors' => true,
            ],
        ];

        if (! empty($headers)) {
            $contextOptions['http']['header'] = implode("\r\n", $headers);
        }

        return stream_context_create($contextOptions);
    }

    /**
     * @param array<string, mixed> $headers
     */
    private function extractTotalPages(array $headers): int
    {
        $totalPages = $headers['X-WP-TotalPages'] ?? $headers['x-wp-totalpages'] ?? null;

        if (is_array($totalPages)) {
            $totalPages = end($totalPages);
        }

        $validated = filter_var($totalPages, FILTER_VALIDATE_INT, [
            'options' => ['min_range' => 1],
        ]);

        return $validated !== false ? $validated : 1;
    }

    private function buildUrl(string $accountUrl, string $path): string
    {
        return rtrim($accountUrl, '/') . $path;
    }
}
