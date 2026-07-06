<?php

namespace App\Listeners;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use TightenCo\Jigsaw\Jigsaw;

class PushHeaderFragments
{
    private const ASSET_BASE_TOKEN = '__LIBRESIGN_HEADER_ASSET_BASE_URL__';
    private const HTML_FRAGMENT_SUFFIX = '/header/index.html';
    private const PUBLISH_FLAG = 'LIBRESIGN_PUBLISH_HEADER_FRAGMENTS';

    public function handle(Jigsaw $jigsaw): void
    {
        if (! $this->shouldPublish()) {
            return;
        }

        $webhookUrl = trim((string) getenv('LIBRESIGN_HEADER_WEBHOOK_URL'));
        $secret = trim((string) getenv('LIBRESIGN_HEADER_WEBHOOK_SECRET'));

        if ($webhookUrl === '' || $secret === '') {
            return;
        }

        $destinationPath = $jigsaw->getDestinationPath();
        $manifest = $this->loadManifest($destinationPath . '/assets/build/manifest.json');
        if ($manifest === []) {
            return;
        }

        $cssArtifactPath = $this->resolveBuildArtifactPath($destinationPath, $manifest, 'source/_assets/scss/header-fragment.scss');
        $jsArtifactPath = $this->resolveBuildArtifactPath($destinationPath, $manifest, 'source/_assets/js/header-fragment.js');

        if ($cssArtifactPath === '' || $jsArtifactPath === '') {
            return;
        }

        $fragments = $this->discoverFragmentFiles($destinationPath);

        foreach ($fragments as $fragmentFile) {
            $payload = $this->buildPayload(
                $fragmentFile,
                $destinationPath,
                $cssArtifactPath,
                $jsArtifactPath
            );

            if ($payload === []) {
                continue;
            }

            $this->dispatch($webhookUrl, $secret, $payload);
        }
    }

    private function loadManifest(string $manifestPath): array
    {
        if (! is_file($manifestPath)) {
            return [];
        }

        $manifest = json_decode((string) file_get_contents($manifestPath), true);
        return is_array($manifest) ? $manifest : [];
    }

    private function resolveBuildArtifactPath(string $destinationPath, array $manifest, string $entry): string
    {
        $file = $manifest[$entry]['file'] ?? '';
        if (! is_string($file) || $file === '') {
            return '';
        }

        return $destinationPath . '/assets/build/' . ltrim($file, '/');
    }

    private function discoverFragmentFiles(string $destinationPath): array
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
                && str_ends_with($relativePath, self::HTML_FRAGMENT_SUFFIX)
            ) {
                $files[] = $pathname;
            }
        }

        sort($files);

        return $files;
    }

    private function buildPayload(string $fragmentFile, string $destinationPath, string $cssArtifactPath, string $jsArtifactPath): array
    {
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
            $tokenizedUrl = self::ASSET_BASE_TOKEN . '/' . ltrim($normalizedPath, '/');

            $html = str_replace($this->assetPublicUrlPatterns($assetPath), $tokenizedUrl, $html);
            $css = str_replace($this->assetPublicUrlPatterns($assetPath), $tokenizedUrl, $css);

            $assets[] = [
                'path' => $normalizedPath,
                'content_base64' => base64_encode((string) file_get_contents($absolutePath)),
                'mime' => mime_content_type($absolutePath) ?: 'application/octet-stream',
            ];
        }

        $relativeFragmentPath = ltrim(str_replace(str_replace('\\', '/', $destinationPath), '', $fragmentFile), '/');
        $locale = $this->extractLocaleFromFragmentPath($relativeFragmentPath);

        return [
            'locale' => $locale,
            'version' => hash('sha256', $html . "\n" . $css . "\n" . $js),
            'generated_at' => gmdate(DATE_ATOM),
            'html' => $html,
            'css' => $css,
            'js' => $js,
            'assets' => $assets,
        ];
    }

    private function extractHtmlAssetPaths(string $html): array
    {
        preg_match_all('/(?:src)=\"([^\"]+)\"/i', $html, $matches);
        return $this->normalizeAssetPaths($matches[1] ?? []);
    }

    private function extractCssAssetPaths(string $css): array
    {
        preg_match_all('/url\(([^)]+)\)/i', $css, $matches);
        return $this->normalizeAssetPaths($matches[1] ?? []);
    }

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
        return ltrim(preg_replace('#^assets/#', '', ltrim($assetPath, '/')) ?? ltrim($assetPath, '/'), '/');
    }

    private function assetPublicUrlPatterns(string $assetPath): array
    {
        $path = '/' . ltrim($assetPath, '/');

        return [
            'http://localhost:8081' . $path,
            'https://libresign.coop' . $path,
            $path,
        ];
    }

    private function dispatch(string $webhookUrl, string $secret, array $payload): void
    {
        $body = json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        if (! is_string($body)) {
            return;
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

        @file_get_contents($webhookUrl, false, $context);
    }

    private function shouldPublish(): bool
    {
        return filter_var(getenv(self::PUBLISH_FLAG), FILTER_VALIDATE_BOOL) === true;
    }

    private function extractLocaleFromFragmentPath(string $relativeFragmentPath): string
    {
        $normalized = trim(str_replace('\\', '/', $relativeFragmentPath), '/');

        if (! str_starts_with($normalized, 'fragments/')) {
            return '';
        }

        $suffix = '/header/index.html';
        if (! str_ends_with($normalized, $suffix)) {
            return '';
        }

        $candidate = substr($normalized, strlen('fragments/'));
        $candidate = substr($candidate, 0, -strlen($suffix));

        return trim((string) $candidate, '/');
    }
}
