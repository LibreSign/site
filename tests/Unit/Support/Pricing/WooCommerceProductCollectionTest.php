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
        yield 'missing account url' => [
            [],
            [],
            [],
        ];

        yield 'featured products endpoint unavailable' => [
            ['accountUrl' => 'https://account.example.test'],
            [],
            [],
        ];

        yield 'languages endpoint unavailable' => [
            ['accountUrl' => 'https://account.example.test'],
            [
                'https://account.example.test/wp-json/wp/v2/product?featured=true&per_page=100&_fields=id,slug,title,date,lang,translations,link,status' => [
                    ['id' => 10, 'status' => 'publish'],
                ],
            ],
            [],
        ];

        yield 'no published featured products' => [
            ['accountUrl' => 'https://account.example.test'],
            [
                'https://account.example.test/wp-json/wp/v2/product?featured=true&per_page=100&_fields=id,slug,title,date,lang,translations,link,status' => [
                    ['id' => 10, 'status' => 'draft'],
                ],
            ],
            [
                'https://account.example.test/wp-json/pll/v1/languages' => json_encode([]),
            ],
        ];
    }

    public function testItemsMapsLocalizedProductsUsingAuthenticatedAttributesWithoutMocks(): void
    {
        $page = new FakeJigsawPage(['accountUrl' => 'https://account.example.test']);
        $collection = new FakeWooCommerceProductCollection(
            [
                'https://account.example.test/wp-json/wp/v2/product?featured=true&per_page=100&_fields=id,slug,title,date,lang,translations,link,status' => [
                    [
                        'id' => 10,
                        'slug' => 'basic',
                        'title' => ['rendered' => 'Basic fallback'],
                        'date' => '2026-07-03T12:00:00',
                        'lang' => 'en',
                        'translations' => ['en' => 10, 'pt-br' => 11],
                        'link' => 'https://account.example.test/product/basic/',
                        'status' => 'publish',
                    ],
                ],
                'https://account.example.test/wp-json/wp/v2/product?include=10,11&orderby=include&per_page=100&_fields=id,slug,title,date,lang,translations,link,status' => [
                    [
                        'id' => 10,
                        'slug' => 'basic',
                        'title' => ['rendered' => 'Basic fallback'],
                        'date' => '2026-07-03T12:00:00',
                        'lang' => 'en',
                        'translations' => ['en' => 10, 'pt-br' => 11],
                        'link' => 'https://account.example.test/product/basic/',
                        'status' => 'publish',
                    ],
                    [
                        'id' => 11,
                        'slug' => 'basic-pt',
                        'title' => ['rendered' => 'Básico fallback'],
                        'date' => '2026-07-03T12:00:00',
                        'lang' => 'pt-br',
                        'translations' => ['en' => 10, 'pt-br' => 11],
                        'link' => 'https://account.example.test/product/basic-pt/',
                        'status' => 'publish',
                    ],
                ],
                'https://account.example.test/wp-json/wc/store/v1/products?include=10,11&orderby=include&per_page=100' => [
                    [
                        'id' => 10,
                        'name' => 'Basic',
                        'short_description' => '<p>Short description</p>',
                        'permalink' => 'https://account.example.test/product/basic/',
                        'type' => 'simple',
                        'is_purchasable' => true,
                        'has_options' => false,
                        'prices' => [
                            'currency_prefix' => 'R$ ',
                            'currency_suffix' => '',
                            'currency_minor_unit' => 2,
                            'currency_decimal_separator' => ',',
                            'currency_thousand_separator' => '.',
                            'price' => '5500',
                            'price_range' => ['min_amount' => '5500'],
                        ],
                        'add_to_cart' => [
                            'text' => 'View product',
                            'single_text' => 'View product',
                        ],
                        'attributes' => [
                            [
                                'name' => 'Storage',
                                'options' => ['1 Gb'],
                                'visible' => true,
                            ],
                        ],
                    ],
                    [
                        'id' => 11,
                        'name' => 'Básico',
                        'short_description' => '<p>Descrição curta</p>',
                        'permalink' => 'https://account.example.test/product/basic-pt/',
                        'type' => 'simple',
                        'is_purchasable' => true,
                        'has_options' => false,
                        'prices' => [
                            'currency_prefix' => 'R$ ',
                            'currency_suffix' => '',
                            'currency_minor_unit' => 2,
                            'currency_decimal_separator' => ',',
                            'currency_thousand_separator' => '.',
                            'price' => '5500',
                            'price_range' => ['min_amount' => '5500'],
                        ],
                        'add_to_cart' => [
                            'text' => 'Ver produto',
                            'single_text' => 'Ver produto',
                        ],
                        'attributes' => [],
                    ],
                ],
                'https://account.example.test/wp-json/wc/v3/products?include=10,11&orderby=include&per_page=100&_fields=id,attributes' => [
                    [
                        'id' => 10,
                        'attributes' => [
                            [
                                'name' => 'Storage',
                                'options' => ['2 Gb'],
                                'visible' => true,
                            ],
                            [
                                'name' => 'pricing_card_colors',
                                'options' => ['background:#EBF7F2', 'button_text:#FFFFFF'],
                                'visible' => true,
                            ],
                        ],
                    ],
                    [
                        'id' => 11,
                        'attributes' => [],
                    ],
                ],
            ],
            [
                'https://account.example.test/wp-json/pll/v1/languages' => json_encode([
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
            'https://account.example.test/wp-json/wp/v2/product?featured=true&per_page=100&_fields=id,slug,title,date,lang,translations,link,status',
            'https://account.example.test/wp-json/wp/v2/product?include=10,11&orderby=include&per_page=100&_fields=id,slug,title,date,lang,translations,link,status',
            'https://account.example.test/wp-json/wc/store/v1/products?include=10,11&orderby=include&per_page=100',
            'https://account.example.test/wp-json/wc/v3/products?include=10,11&orderby=include&per_page=100&_fields=id,attributes',
        ], $collection->requestedJsonUrls());
        self::assertSame([
            'https://account.example.test/wp-json/pll/v1/languages',
        ], $collection->requestedContentUrls());
    }
}

final class FakeWooCommerceProductCollection extends WooCommerceProductCollection
{
    private array $requestedJsonUrls = [];

    private array $requestedContentUrls = [];

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
