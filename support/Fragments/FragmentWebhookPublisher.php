<?php

declare(strict_types=1);

namespace App\Support\Fragments;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RuntimeException;

class FragmentWebhookPublisher
{
    /**
     * @var array<string, array{html_fragment_suffix: string, asset_base_token: string, css_entry: string, js_entry: string}>
     */
    private const FRAGMENT_CONFIG = [
        'header' => [
            'html_fragment_suffix' => '/header/index.html',
            'asset_base_token' => '__LIBRESIGN_HEADER_ASSET_BASE_URL__',
            'css_entry' => 'source/_assets/scss/header-fragment.scss',
            'js_entry' => 'source/_assets/js/header-fragment.js',
        ],
        'footer' => [
            'html_fragment_suffix' => '/footer/index.html',
            'asset_base_token' => '__LIBRESIGN_FOOTER_ASSET_BASE_URL__',
            'css_entry' => 'source/_assets/scss/footer-fragment.scss',
            'js_entry' => 'source/_assets/js/footer-fragment.js',
        ],
    ];

    /**
     * @param array<string, mixed> $deployment
     */
    public function publish(
        string $fragmentType,
        string $destinationPath,
        string $webhookUrl,
        string $secret,
        array $deployment = [],
    ): int {
        $webhookUrl = trim($webhookUrl);
        $secret = trim($secret);

        if ($webhookUrl === '' || $secret === '') {
            return 0;
        }

        $published = 0;
        foreach ($this->buildPayloads($fragmentType, $destinationPath, $deployment) as $payload) {
            $this->dispatch($webhookUrl, $secret, $payload);
            $published++;
        }

        return $published;
    }

    /**
     * @param array<string, mixed> $deployment
     * @return list<array<string, mixed>>
     */
    public function buildPayloads(string $fragmentType, string $destinationPath, array $deployment = []): array
    {
        $config = self::FRAGMENT_CONFIG[$fragmentType] ?? null;
        if (! is_array($config)) {
            return [];
        }

        $manifest = $this->loadManifest($destinationPath . '/assets/build/manifest.json');
        if ($manifest === []) {
            return [];
        }

        $cssArtifactPath = $this->resolveBuildArtifactPath($destinationPath, $manifest, $config['css_entry']);
        $jsArtifactPath = $this->resolveBuildArtifactPath($destinationPath, $manifest, $config['js_entry']);

        if ($cssArtifactPath === '' || $jsArtifactPath === '') {
            return [];
        }

        $payloads = [];

        foreach ($this->discoverFragmentFiles($destinationPath, $config['html_fragment_suffix']) as $fragmentFile) {
            $payload = $this->buildPayload(
                $fragmentType,
                $fragmentFile,
                $destinationPath,
                $cssArtifactPath,
                $jsArtifactPath,
                $config['asset_base_token'],
                $deployment,
            );

            if ($payload !== []) {
                $payloads[] = $payload;
            }
        }

        return $payloads;
    }

    /**
     * @return array<string, mixed>
     */
    private function loadManifest(string $manifestPath): array
    {
        if (! is_file($manifestPath)) {
            return [];
        }

        $manifest = json_decode((string) file_get_contents($manifestPath), true);

        return is_array($manifest) ? $manifest : [];
    }

    /**
     * @param array<string, mixed> $manifest
     */
    private function resolveBuildArtifactPath(string $destinationPath, array $manifest, string $entry): string
    {
        $file = $manifest[$entry]['file'] ?? '';
        if (! is_string($file) || $file === '') {
            return '';
        }

        return $destinationPath . '/assets/build/' . ltrim($file, '/');
    }

    /**
     * @return list<string>
     */
    private function discoverFragmentFiles(string $destinationPath, string $htmlFragmentSuffix): array
    {
        $files = [];

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($destinationPath, RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($iterator as $fileInfo) {
            if (! $fileInfo->isFile()) {
                continue;
            }

            $pathname = str_replace('\\', '/', $fileInfo->getPathname());
            $relativePath = ltrim(str_replace(str_replace('\\', '/', $destinationPath), '', $pathname), '/');

            if (
                str_starts_with($relativePath, 'fragments/')
                && str_ends_with($relativePath, $htmlFragmentSuffix)
            ) {
                $files[] = $pathname;
            }
        }

        sort($files);

        return $files;
    }

    /**
     * @param array<string, mixed> $deployment
     * @return array<string, mixed>
     */
    private function buildPayload(
        string $fragmentType,
        string $fragmentFile,
        string $destinationPath,
        string $cssArtifactPath,
        string $jsArtifactPath,
        string $assetBaseToken,
        array $deployment = [],
    ): array {
        $html = (string) file_get_contents($fragmentFile);
        $css = (string) file_get_contents($cssArtifactPath);
        $js = (string) file_get_contents($jsArtifactPath);

        $html = preg_replace('/\s+data-fragment-css="[^"]+"/', '', $html) ?? $html;
        $html = preg_replace('/\s+data-fragment-js="[^"]+"/', '', $html) ?? $html;

        $assets = [];

        $htmlAssetPaths = $this->extractHtmlAssetPaths($html);
        $cssAssetPaths = $this->extractCssAssetPaths($css);
        $assetPaths = array_values(array_unique(array_merge($htmlAssetPaths, $cssAssetPaths)));

        foreach ($assetPaths as $assetPath) {
            $absolutePath = $destinationPath . '/' . ltrim($assetPath, '/');
            if (! is_file($absolutePath)) {
                continue;
            }

            $normalizedPath = $this->normalizeStoredAssetPath($assetPath);
            $tokenizedUrl = $assetBaseToken . '/' . ltrim($normalizedPath, '/');

            $html = str_replace($this->assetPublicUrlPatterns($assetPath), $tokenizedUrl, $html);
            $css = str_replace($this->assetPublicUrlPatterns($assetPath), $tokenizedUrl, $css);

            $assets[] = [
                'path' => $normalizedPath,
                'content_base64' => base64_encode((string) file_get_contents($absolutePath)),
                'mime' => mime_content_type($absolutePath) ?: 'application/octet-stream',
            ];
        }

        $relativeFragmentPath = ltrim(str_replace(str_replace('\\', '/', $destinationPath), '', str_replace('\\', '/', $fragmentFile)), '/');
        $locale = $this->extractLocaleFromFragmentPath($relativeFragmentPath, $fragmentType);

        $payload = [
            'fragment_type' => $fragmentType,
            'locale' => $locale,
            'version' => hash('sha256', $html . "\n" . $css . "\n" . $js),
            'generated_at' => gmdate(DATE_ATOM),
            'html' => $html,
            'css' => $css,
            'js' => $js,
            'assets' => $assets,
        ];

        if ($deployment !== []) {
            $payload['deployment'] = $deployment;
        }

        return $payload;
    }

    /**
     * @return list<string>
     */
    private function extractHtmlAssetPaths(string $html): array
    {
        preg_match_all('/(?:src)="([^"]+)"/i', $html, $matches);

        return $this->normalizeAssetPaths($matches[1] ?? []);
    }

    /**
     * @return list<string>
     */
    private function extractCssAssetPaths(string $css): array
    {
        preg_match_all('/url\(([^)]+)\)/i', $css, $matches);

        return $this->normalizeAssetPaths($matches[1] ?? []);
    }

    /**
     * @param array<int, mixed> $values
     * @return list<string>
     */
    private function normalizeAssetPaths(array $values): array
    {
        $paths = [];

        foreach ($values as $value) {
            $value = trim((string) $value, " \t\n\r\0\x0B'\"");
            $path = parse_url($value, PHP_URL_PATH);
            if (! is_string($path) || $path === '') {
                continue;
            }

            if (! str_starts_with($path, '/assets/')) {
                continue;
            }

            $paths[] = ltrim($path, '/');
        }

        return array_values(array_unique($paths));
    }

    private function normalizeStoredAssetPath(string $assetPath): string
    {
        return ltrim(
            preg_replace('#^assets/#', '', ltrim($assetPath, '/')) ?? ltrim($assetPath, '/'),
            '/'
        );
    }

    /**
     * @return list<string>
     */
    private function assetPublicUrlPatterns(string $assetPath): array
    {
        $path = '/' . ltrim($assetPath, '/');

        return [
            'http://localhost:8081' . $path,
            'https://libresign.coop' . $path,
            $path,
        ];
    }

    /**
     * @param array<string, mixed> $payload
     */
    protected function dispatch(string $webhookUrl, string $secret, array $payload): void
    {
        $body = json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        if (! is_string($body)) {
            throw new RuntimeException('Unable to encode fragment webhook payload.');
        }

        $timestamp = (string) time();
        $signature = hash_hmac('sha256', $timestamp . "\n" . $body, $secret);

        $context = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => implode("\r\n", [
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($body),
                    'X-LibreSign-Timestamp: ' . $timestamp,
                    'X-LibreSign-Signature: sha256=' . $signature,
                ]),
                'content' => $body,
                'timeout' => 20,
                'ignore_errors' => true,
            ],
        ]);

        $result = @file_get_contents($webhookUrl, false, $context);
        $headers = $http_response_header ?? [];
        $statusCode = $this->extractStatusCode($headers);

        if ($result === false || $statusCode < 200 || $statusCode >= 300) {
            throw new RuntimeException(sprintf(
                'Fragment webhook dispatch failed for %s with status %s.',
                $webhookUrl,
                $statusCode > 0 ? (string) $statusCode : 'unknown'
            ));
        }
    }

    /**
     * @param array<int, string> $headers
     */
    private function extractStatusCode(array $headers): int
    {
        $statusLine = $headers[0] ?? '';
        if (! is_string($statusLine)) {
            return 0;
        }

        if (preg_match('/\s(\d{3})\s/', $statusLine, $matches) !== 1) {
            return 0;
        }

        return (int) $matches[1];
    }

    private function extractLocaleFromFragmentPath(string $relativeFragmentPath, string $fragmentType): string
    {
        $normalized = trim(str_replace('\\', '/', $relativeFragmentPath), '/');

        if (! str_starts_with($normalized, 'fragments/')) {
            return '';
        }

        $suffix = '/' . $fragmentType . '/index.html';
        if (! str_ends_with($normalized, $suffix)) {
            return '';
        }

        $candidate = substr($normalized, strlen('fragments/'));
        $candidate = substr($candidate, 0, -strlen($suffix));

        return trim((string) $candidate, '/');
    }
}
