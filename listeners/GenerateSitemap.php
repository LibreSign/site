<?php namespace App\Listeners;

use samdark\sitemap\Sitemap;
use TightenCo\Jigsaw\Jigsaw;

class GenerateSitemap
{
    public function handle(Jigsaw $jigsaw)
    {
        $siteHost = trim((string) file_get_contents('CNAME'));
        $imageLookup = $this->buildImageLookup($jigsaw, $siteHost);
        $sitemap = new Sitemap($jigsaw->getDestinationPath() . '/sitemap.xml');

        $jigsaw->getPages()
            ->each(function ($pageData, $path) use ($siteHost, $imageLookup, $sitemap) {
                $normalizedPath = $this->normalizeOutputPath((string) $path);

                if ($this->isAsset($normalizedPath)) {
                    return;
                }

                $sitemap->addItem(
                    $this->normalizeSiteUrl($siteHost, $normalizedPath),
                    time(),
                    Sitemap::DAILY,
                    null,
                    $imageLookup[$normalizedPath] ?? [],
                );
            });

        $sitemap->write();
    }

    /**
     * @return array<string, list<string>>
     */
    protected function buildImageLookup(Jigsaw $jigsaw, string $siteHost): array
    {
        $lookup = [];

        foreach (['posts', 'posts_wordpress'] as $collectionName) {
            $collection = $jigsaw->getCollection($collectionName);

            if (! is_iterable($collection)) {
                continue;
            }

            foreach ($collection as $item) {
                $path = $this->normalizeOutputPath($item->getPath());
                $images = $this->resolveImages($siteHost, $item);

                if ($images === []) {
                    continue;
                }

                $lookup[$path] = $images;
            }
        }

        return $lookup;
    }

    protected function normalizeSiteUrl(string $siteHost, string $path): string
    {
        return 'https://' . $siteHost . ($path === '/' ? '/' : '/' . ltrim($path, '/'));
    }

    /**
     * @return list<string>
     */
    protected function resolveImages(string $siteHost, $page): array
    {
        if (! is_object($page)) {
            return [];
        }

        foreach (['banner', 'cover_image'] as $property) {
            $value = $page->{$property} ?? null;

            if (! is_string($value) || $value === '') {
                continue;
            }

            $normalized = $this->normalizeImageUrl($siteHost, $value);

            if ($normalized === null || $this->isDefaultImage($siteHost, $normalized)) {
                continue;
            }

            return [$normalized];
        }

        return [];
    }

    protected function normalizeOutputPath(string $path): string
    {
        $urlPath = parse_url($path, PHP_URL_PATH);

        if (! is_string($urlPath) || $urlPath === '') {
            return '/';
        }

        return $urlPath === '/' ? '/' : '/' . ltrim($urlPath, '/');
    }

    protected function normalizeImageUrl(string $siteHost, string $url): ?string
    {
        $trimmed = trim($url);

        if ($trimmed === '') {
            return null;
        }

        if (filter_var($trimmed, FILTER_VALIDATE_URL)) {
            return $trimmed;
        }

        return $this->normalizeSiteUrl($siteHost, $trimmed);
    }

    protected function isDefaultImage(string $siteHost, string $url): bool
    {
        return in_array($url, [
            $this->normalizeSiteUrl($siteHost, '/assets/images/logo/logo.svg'),
        ], true);
    }

    public function isAsset($path)
    {
        return str_starts_with($path, '/assets')
            || str_starts_with($path, '/fragments/');
    }
}
