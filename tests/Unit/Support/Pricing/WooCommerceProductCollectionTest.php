<?php

declare(strict_types=1);

namespace Tests\Unit\Support\Pricing;

use App\Support\Pricing\WooCommerceProductCollection;
use App\Support\Pricing\WooCommerceProductTransformer;
use Illuminate\Support\Collection;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class WooCommerceProductCollectionTest extends TestCase
{
    private const ACCOUNT_URL = 'https://account.example.test';

    private const PRODUCT_FIELDS = 'id,slug,title,date,lang,translations,link,status';

    #[DataProvider('emptyItemsProvider')]
    public function testItemsReturnsEmptyCollectionWhenInputsAreUnavailable(
        array $pageConfig,
        array $jsonResponses,
        array $contentResponses,
        array $authenticatedHeaders = [],
    ): void {
        $page = new FakeJigsawPage($pageConfig);
        $collection = new FakeWooCommerceProductCollection(
            $jsonResponses,
            $contentResponses,
            $authenticatedHeaders,
        );

        $items = $collection->items($page);

        self::assertInstanceOf(Collection::class, $items);
        self::assertCount(0, $items);
    }

    public static function emptyItemsProvider(): iterable
    {
        $featuredProductsUrl = self::featuredProductsUrl();
        $languagesUrl = self::languagesUrl();

        yield 'missing account url' => [
            [],
            [],
            [],
        ];

        yield 'featured products endpoint unavailable' => [
            ['accountUrl' => self::ACCOUNT_URL],
            [],
            [],
        ];

        yield 'languages endpoint unavailable' => [
            ['accountUrl' => self::ACCOUNT_URL],
            [
                $featuredProductsUrl => [
                    self::wpProduct(['id' => 10]),
                ],
            ],
            [],
        ];

        yield 'no published featured products' => [
            ['accountUrl' => self::ACCOUNT_URL],
            [
                $featuredProductsUrl => [
                    self::wpProduct(['id' => 10, 'status' => 'draft']),
                ],
            ],
            [
                $languagesUrl => json_encode([]),
            ],
        ];
    }

    public function testItemsMapsLocalizedProductsUsingAuthenticatedAttributesWithoutMocks(): void
    {
        $page = new FakeJigsawPage(['accountUrl' => self::ACCOUNT_URL]);
        $localizedProductsUrl = self::localizedProductsUrl([10, 11]);
        $storeProductsUrl = self::storeProductsUrl([10, 11]);
        $authenticatedProductsUrl = self::authenticatedProductsUrl([10, 11]);

        $collection = new FakeWooCommerceProductCollection(
            [
                self::featuredProductsUrl() => [
                    self::wpProduct([
                        'id' => 10,
                        'slug' => 'basic',
                        'title' => ['rendered' => 'Basic fallback'],
                        'date' => '2026-07-03T12:00:00',
                        'lang' => 'en',
                        'translations' => ['en' => 10, 'pt-br' => 11],
                        'link' => self::productUrl('basic'),
                    ]),
                ],
                $localizedProductsUrl => [
                    self::wpProduct([
                        'id' => 10,
                        'slug' => 'basic',
                        'title' => ['rendered' => 'Basic fallback'],
                        'date' => '2026-07-03T12:00:00',
                        'lang' => 'en',
                        'translations' => ['en' => 10, 'pt-br' => 11],
                        'link' => self::productUrl('basic'),
                    ]),
                    self::wpProduct([
                        'id' => 11,
                        'slug' => 'basic-pt',
                        'title' => ['rendered' => 'Básico fallback'],
                        'date' => '2026-07-03T12:00:00',
                        'lang' => 'pt-br',
                        'translations' => ['en' => 10, 'pt-br' => 11],
                        'link' => self::productUrl('basic-pt'),
                    ]),
                ],
                $storeProductsUrl => [
                    self::storeProduct([
                        'id' => 10,
                        'name' => 'Basic',
                        'short_description' => '<p>Short description</p>',
                        'permalink' => self::productUrl('basic'),
                        'prices' => self::prices([
                            'price_range' => ['min_amount' => '5500'],
                        ]),
                        'attributes' => [
                            self::attribute('Storage', ['1 Gb']),
                        ],
                    ]),
                    self::storeProduct([
                        'id' => 11,
                        'name' => 'Básico',
                        'short_description' => '<p>Descrição curta</p>',
                        'permalink' => self::productUrl('basic-pt'),
                        'add_to_cart' => [
                            'text' => 'Ver produto',
                            'single_text' => 'Ver produto',
                        ],
                        'prices' => self::prices([
                            'price_range' => ['min_amount' => '5500'],
                        ]),
                        'attributes' => [],
                    ]),
                ],
                $authenticatedProductsUrl => [
                    [
                        'id' => 10,
                        'attributes' => [
                            self::attribute('Storage', ['2 Gb']),
                            self::attribute('pricing_card_colors', ['background:#EBF7F2', 'button_text:#FFFFFF']),
                        ],
                    ],
                    [
                        'id' => 11,
                        'attributes' => [],
                    ],
                ],
            ],
            [
                self::languagesUrl() => json_encode([
                    ['slug' => 'en', 'w3c' => 'en-US'],
                    ['slug' => 'pt-br', 'w3c' => 'pt-BR'],
                ]),
            ],
            ['Authorization: Basic test'],
            new WooCommerceProductTransformer(),
        );

        $items = $collection->items($page);

        self::assertCount(2, $items);
        self::assertSame('Basic', $items[0]['title']);
        self::assertSame('2 Gb', $items[0]['attributes'][0]['values'][0]);
        self::assertSame([
            'background' => '#EBF7F2',
            'button_text' => '#FFFFFF',
        ], $items[0]['pricingCardColors']);
        self::assertSame('Básico', $items[1]['title']);
        self::assertSame('pt-BR', $items[1]['lang']);
        self::assertSame([
            self::featuredProductsUrl(),
            $localizedProductsUrl,
            $storeProductsUrl,
            $authenticatedProductsUrl,
        ], $collection->requestedJsonUrls());
        self::assertSame([
            self::languagesUrl(),
        ], $collection->requestedContentUrls());
    }

    public function testItBuildsProductWithoutAuthenticatedWooCommerceData(): void
    {
        $page = new FakeJigsawPage(['accountUrl' => self::ACCOUNT_URL]);
        $localizedProductsUrl = self::localizedProductsUrl([10]);
        $storeProductsUrl = self::storeProductsUrl([10]);
        $authenticatedProductsUrl = self::authenticatedProductsUrl([10]);

        $collection = new FakeWooCommerceProductCollection(
            [
                self::featuredProductsUrl() => [
                    self::wpProduct([
                        'id' => 10,
                        'slug' => 'basic',
                        'title' => ['rendered' => 'Basic fallback'],
                        'date' => '2026-07-03T12:00:00',
                        'lang' => 'en',
                        'translations' => ['en' => 10],
                        'link' => self::productUrl('basic'),
                    ]),
                ],
                $localizedProductsUrl => [
                    self::wpProduct([
                        'id' => 10,
                        'slug' => 'basic',
                        'title' => ['rendered' => 'Basic fallback'],
                        'date' => '2026-07-03T12:00:00',
                        'lang' => 'en',
                        'translations' => ['en' => 10],
                        'link' => self::productUrl('basic'),
                    ]),
                ],
                $storeProductsUrl => [
                    self::storeProduct([
                        'id' => 10,
                        'name' => 'Basic',
                        'short_description' => '<p>Short description</p>',
                        'permalink' => self::productUrl('basic'),
                        'attributes' => [
                            self::attribute('Storage', ['1 Gb']),
                        ],
                    ]),
                ],
            ],
            [
                self::languagesUrl() => json_encode([
                    ['slug' => 'en', 'w3c' => 'en-US'],
                ]),
            ],
            [],
            new WooCommerceProductTransformer(),
        );

        $items = $collection->items($page);

        self::assertCount(1, $items);
        self::assertSame('Basic', $items[0]['title']);
        self::assertSame('basic', $items[0]['slug']);
        self::assertSame('R$ 55,00', $items[0]['price']);
        self::assertSame('<p>Short description</p>', $items[0]['description']);
        self::assertSame('https://account.example.test/product/basic/', $items[0]['permalink']);
        self::assertSame('Storage', $items[0]['attributes'][0]['name']);
        self::assertSame(['1 Gb'], $items[0]['attributes'][0]['values']);
        self::assertSame([], $collection->authenticatedEnrichmentFailures());
        self::assertNotContains(
            $authenticatedProductsUrl,
            $collection->requestedJsonUrls()
        );
    }

    public function testAuthenticatedEndpointFailureFallsBackToPublicStoreData(): void
    {
        $page = new FakeJigsawPage(['accountUrl' => self::ACCOUNT_URL]);
        $localizedProductsUrl = self::localizedProductsUrl([10]);
        $storeProductsUrl = self::storeProductsUrl([10]);
        $authenticatedProductsUrl = self::authenticatedProductsUrl([10]);

        $collection = new FakeWooCommerceProductCollection(
            [
                self::featuredProductsUrl() => [
                    self::wpProduct([
                        'id' => 10,
                        'slug' => 'basic',
                        'title' => ['rendered' => 'Basic fallback'],
                        'date' => '2026-07-03T12:00:00',
                        'lang' => 'en',
                        'translations' => ['en' => 10],
                        'link' => self::productUrl('basic'),
                    ]),
                ],
                $localizedProductsUrl => [
                    self::wpProduct([
                        'id' => 10,
                        'slug' => 'basic',
                        'title' => ['rendered' => 'Basic fallback'],
                        'date' => '2026-07-03T12:00:00',
                        'lang' => 'en',
                        'translations' => ['en' => 10],
                        'link' => self::productUrl('basic'),
                    ]),
                ],
                $storeProductsUrl => [
                    self::storeProduct([
                        'id' => 10,
                        'name' => 'Basic',
                        'short_description' => '<p>Short description</p>',
                        'permalink' => self::productUrl('basic'),
                        'attributes' => [
                            self::attribute('Storage', ['1 Gb']),
                        ],
                    ]),
                ],
                // Intentionally missing authenticated endpoint response to simulate outage.
            ],
            [
                self::languagesUrl() => json_encode([
                    ['slug' => 'en', 'w3c' => 'en-US'],
                ]),
            ],
            ['Authorization: Basic test'],
            new WooCommerceProductTransformer(),
        );

        $items = $collection->items($page);

        self::assertCount(1, $items);
        self::assertSame('Basic', $items[0]['title']);
        self::assertSame(['1 Gb'], $items[0]['attributes'][0]['values']);
        self::assertSame([
            $authenticatedProductsUrl,
        ], $collection->authenticatedEnrichmentFailures());
    }

    private static function featuredProductsUrl(): string
    {
        return self::ACCOUNT_URL
            . '/wp-json/wp/v2/product?featured=true&per_page=100&_fields=' . self::PRODUCT_FIELDS;
    }

    /**
     * @param array<int> $ids
     */
    private static function localizedProductsUrl(array $ids): string
    {
        return self::ACCOUNT_URL
            . '/wp-json/wp/v2/product?include=' . implode(',', $ids)
            . '&orderby=include&per_page=100&_fields=' . self::PRODUCT_FIELDS;
    }

    /**
     * @param array<int> $ids
     */
    private static function storeProductsUrl(array $ids): string
    {
        return self::ACCOUNT_URL
            . '/wp-json/wc/store/v1/products?include=' . implode(',', $ids)
            . '&orderby=include&per_page=100';
    }

    /**
     * @param array<int> $ids
     */
    private static function authenticatedProductsUrl(array $ids): string
    {
        return self::ACCOUNT_URL
            . '/wp-json/wc/v3/products?include=' . implode(',', $ids)
            . '&orderby=include&per_page=100&_fields=id,attributes';
    }

    private static function languagesUrl(): string
    {
        return self::ACCOUNT_URL . '/wp-json/pll/v1/languages';
    }

    private static function productUrl(string $slug): string
    {
        return self::ACCOUNT_URL . '/product/' . $slug . '/';
    }

    private static function wpProduct(array $overrides = []): array
    {
        return self::mergeRecursiveDistinct([
            'id' => 10,
            'slug' => 'basic',
            'title' => ['rendered' => 'Basic fallback'],
            'date' => '2026-07-03T12:00:00',
            'lang' => 'en',
            'translations' => ['en' => 10],
            'link' => self::productUrl('basic'),
            'status' => 'publish',
        ], $overrides);
    }

    private static function storeProduct(array $overrides = []): array
    {
        return self::mergeRecursiveDistinct([
            'id' => 10,
            'name' => 'Basic',
            'short_description' => '<p>Short description</p>',
            'permalink' => self::productUrl('basic'),
            'type' => 'simple',
            'is_purchasable' => true,
            'has_options' => false,
            'prices' => self::prices(),
            'add_to_cart' => [
                'text' => 'View product',
                'single_text' => 'View product',
            ],
            'attributes' => [],
        ], $overrides);
    }

    private static function prices(array $overrides = []): array
    {
        return self::mergeRecursiveDistinct([
            'currency_prefix' => 'R$ ',
            'currency_suffix' => '',
            'currency_minor_unit' => 2,
            'currency_decimal_separator' => ',',
            'currency_thousand_separator' => '.',
            'price' => '5500',
        ], $overrides);
    }

    private static function attribute(string $name, array $options, bool $visible = true): array
    {
        return [
            'name' => $name,
            'options' => $options,
            'visible' => $visible,
        ];
    }

    private static function mergeRecursiveDistinct(array $base, array $overrides): array
    {
        foreach ($overrides as $key => $value) {
            if (is_array($value) && isset($base[$key]) && is_array($base[$key])) {
                $base[$key] = self::mergeRecursiveDistinct($base[$key], $value);
                continue;
            }

            $base[$key] = $value;
        }

        return $base;
    }
}

final class FakeWooCommerceProductCollection extends WooCommerceProductCollection
{
    private array $requestedJsonUrls = [];

    private array $requestedContentUrls = [];

    private array $authenticatedEnrichmentFailures = [];

    public function __construct(
        private readonly array $jsonResponses,
        private readonly array $contentResponses,
        array $authenticatedHeaders = [],
        ?WooCommerceProductTransformer $transformer = null,
    ) {
        parent::__construct($authenticatedHeaders, 15, $transformer);
    }

    protected function fetchJson(string $url, array $headers = []): ?array
    {
        $this->requestedJsonUrls[] = $url;

        return $this->jsonResponses[$url] ?? null;
    }

    protected function fetchContent(string $url, array $headers = []): string|false
    {
        $this->requestedContentUrls[] = $url;

        return $this->contentResponses[$url] ?? false;
    }

    public function requestedJsonUrls(): array
    {
        return $this->requestedJsonUrls;
    }

    public function requestedContentUrls(): array
    {
        return $this->requestedContentUrls;
    }

    public function authenticatedEnrichmentFailures(): array
    {
        return $this->authenticatedEnrichmentFailures;
    }

    protected function logAuthenticatedEnrichmentFailure(string $url): void
    {
        $this->authenticatedEnrichmentFailures[] = $url;
    }
}

final class FakeJigsawPage
{
    public function __construct(private readonly array $config)
    {
    }

    public function get(string $key)
    {
        return $this->config[$key] ?? null;
    }
}

