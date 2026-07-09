<?php

declare(strict_types=1);

namespace App\Support\Pricing;

use Illuminate\Support\Collection;

class WooCommerceProductCollection
{
    private readonly WooCommerceProductTransformer $transformer;

    public function __construct(
        private readonly array $authenticatedHeaders = [],
        private readonly int $timeout = 15,
        ?WooCommerceProductTransformer $transformer = null,
    ) {
        $this->transformer = $transformer ?? new WooCommerceProductTransformer();
    }

    public function items($page): Collection
    {
        if (empty($page->get('accountUrl'))) {
            return collect();
        }

        $accountUrl = rtrim((string) $page->get('accountUrl'), '/');
        $productFields = 'id,slug,title,date,lang,translations,link,status';
        $featuredProductsResponse = $this->fetchJson(
            $accountUrl . '/wp-json/wp/v2/product?featured=true&per_page=100&_fields=' . $productFields
        );
        $languagesResponse = $this->fetchContent($accountUrl . '/wp-json/pll/v1/languages');

        if ($featuredProductsResponse === null || $languagesResponse === false) {
            return collect();
        }

        $featuredProducts = collect($featuredProductsResponse)
            ->filter(fn (array $product) => ($product['status'] ?? null) === 'publish')
            ->values();
        $wordPressLanguages = json_decode($languagesResponse) ?: [];

        if ($featuredProducts->isEmpty()) {
            return collect();
        }

        $localizedProductIds = $featuredProducts
            ->flatMap(function (array $product) {
                $translationIds = array_values(array_filter($product['translations'] ?? []));

                return array_values(array_unique(array_merge([
                    $product['id'],
                ], $translationIds)));
            })
            ->unique()
            ->values();

        $localizedProductsById = $this->fetchLocalizedProducts($localizedProductIds, $accountUrl, $productFields);
        $productDetailsById = $this->fetchStoreProductDetails($localizedProductIds, $accountUrl);
        $authenticatedProductDetailsById = $this->fetchAuthenticatedProductDetails($localizedProductIds, $accountUrl);

        return $localizedProductIds
            ->map(function (int $productId) use (
                $localizedProductsById,
                $productDetailsById,
                $authenticatedProductDetailsById,
                $wordPressLanguages,
            ) {
                $fromApi = $localizedProductsById->get($productId);

                if (!is_array($fromApi)) {
                    return null;
                }

                return $this->transformer->mapProduct(
                    $fromApi,
                    $productDetailsById->get($productId, []),
                    $authenticatedProductDetailsById->get($productId, []),
                    $wordPressLanguages
                );
            })
            ->filter()
            ->values();
    }

    private function fetchLocalizedProducts(Collection $localizedProductIds, string $accountUrl, string $productFields): Collection
    {
        return $localizedProductIds
            ->chunk(100)
            ->flatMap(function (Collection $chunk) use ($accountUrl, $productFields) {
                return $this->fetchJson(
                    $accountUrl
                    . '/wp-json/wp/v2/product?include=' . implode(',', $chunk->all())
                    . '&orderby=include&per_page=100&_fields=' . $productFields
                ) ?: [];
            })
            ->filter(fn (array $product) => ($product['status'] ?? null) === 'publish')
            ->keyBy('id');
    }

    private function fetchStoreProductDetails(Collection $localizedProductIds, string $accountUrl): Collection
    {
        return $localizedProductIds
            ->chunk(100)
            ->flatMap(function (Collection $chunk) use ($accountUrl) {
                return $this->fetchJson(
                    $accountUrl
                    . '/wp-json/wc/store/v1/products?include=' . implode(',', $chunk->all())
                    . '&orderby=include&per_page=100'
                ) ?: [];
            })
            ->filter(fn (array $product) => isset($product['id']))
            ->keyBy('id');
    }

    private function fetchAuthenticatedProductDetails(Collection $localizedProductIds, string $accountUrl): Collection
    {
        if (empty($this->authenticatedHeaders)) {
            return collect();
        }

        return $localizedProductIds
            ->chunk(100)
            ->flatMap(function (Collection $chunk) use ($accountUrl) {
                return $this->fetchJson(
                    $accountUrl
                    . '/wp-json/wc/v3/products?include=' . implode(',', $chunk->all())
                    . '&orderby=include&per_page=100&_fields=id,attributes',
                    $this->authenticatedHeaders
                ) ?: [];
            })
            ->filter(fn (array $product) => isset($product['id']))
            ->keyBy('id');
    }

    protected function fetchJson(string $url, array $headers = []): ?array
    {
        $response = $this->fetchContent($url, $headers);

        return $response ? (json_decode($response, true) ?: null) : null;
    }

    protected function fetchContent(string $url, array $headers = []): string|false
    {
        return @file_get_contents($url, false, $this->createStreamContext($headers));
    }

    protected function createStreamContext(array $headers = [])
    {
        $contextOptions = [
            'http' => [
                'timeout' => $this->timeout,
            ],
        ];

        if (!empty($headers)) {
            $contextOptions['http']['header'] = implode("\r\n", $headers);
        }

        return stream_context_create($contextOptions);
    }

}
