<?php

declare(strict_types=1);

namespace Tests\Unit\Support\Pricing;

use App\Support\Pricing\WooCommerceProductTransformer;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class WooCommerceProductTransformerTest extends TestCase
{
    private WooCommerceProductTransformer $transformer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->transformer = new WooCommerceProductTransformer();
    }

    #[DataProvider('formatWooCommercePriceProvider')]
    public function testFormatWooCommercePrice(array $prices, ?string $amount, ?string $expected): void
    {
        self::assertSame($expected, $this->transformer->formatWooCommercePrice($prices, $amount));
    }

    public static function formatWooCommercePriceProvider(): iterable
    {
        yield 'null amount returns null' => [
            ['currency_prefix' => 'R$ ', 'currency_minor_unit' => 2],
            null,
            null,
        ];

        yield 'formats brazilian currency' => [
            [
                'currency_prefix' => 'R$ ',
                'currency_suffix' => '',
                'currency_minor_unit' => 2,
                'currency_decimal_separator' => ',',
                'currency_thousand_separator' => '.',
            ],
            '5500',
            'R$ 55,00',
        ];

        yield 'formats amount without minor unit' => [
            [
                'currency_prefix' => '',
                'currency_suffix' => ' credits',
                'currency_minor_unit' => 0,
                'currency_decimal_separator' => ',',
                'currency_thousand_separator' => '.',
            ],
            '1200',
            '1.200 credits',
        ];
    }

    #[DataProvider('normalizeWooCommerceAttributeProvider')]
    public function testNormalizeWooCommerceAttribute(array $attribute, ?array $expected): void
    {
        self::assertSame($expected, $this->transformer->normalizeWooCommerceAttribute($attribute));
    }

    public static function normalizeWooCommerceAttributeProvider(): iterable
    {
        yield 'uses terms when available' => [
            [
                'name' => 'Storage',
                'terms' => [
                    ['name' => '2 Gb'],
                    ['name' => '120 Gb'],
                ],
                'visible' => true,
            ],
            [
                'name' => 'Storage',
                'values' => ['2 Gb', '120 Gb'],
                'visible' => true,
            ],
        ];

        yield 'falls back to string options' => [
            [
                'name' => 'Term length',
                'options' => ['monthly', 'yearly'],
                'visible' => false,
            ],
            [
                'name' => 'Term length',
                'values' => ['monthly', 'yearly'],
                'visible' => false,
            ],
        ];

        yield 'returns null for empty values' => [
            [
                'name' => 'Empty',
                'terms' => [],
                'options' => ['   ', null],
            ],
            null,
        ];
    }

    #[DataProvider('parsePricingCardColorsProvider')]
    public function testParsePricingCardColors(array $attributes, array $expected): void
    {
        self::assertSame($expected, $this->transformer->parsePricingCardColors($attributes));
    }

    public static function parsePricingCardColorsProvider(): iterable
    {
        yield 'parses valid pricing colors' => [
            [
                [
                    'name' => 'Pricing Card Colors',
                    'values' => [
                        'background:#0f6e56',
                        'button_text:#ffffff',
                        'border:D4F0E4',
                    ],
                ],
            ],
            [
                'background' => '#0F6E56',
                'button_text' => '#FFFFFF',
                'border' => '#D4F0E4',
            ],
        ];

        yield 'ignores invalid color definitions' => [
            [
                [
                    'name' => 'pricing_card_colors',
                    'values' => [
                        'background:not-a-color',
                        'accent:',
                        'check:#12345G',
                    ],
                ],
            ],
            [],
        ];

        yield 'ignores unrelated attributes' => [
            [
                [
                    'name' => 'Storage',
                    'values' => ['2 Gb'],
                ],
            ],
            [],
        ];
    }

    public function testMapProductBuildsExpectedPayloadWithoutMocks(): void
    {
        $fromApi = [
            'id' => 10,
            'slug' => 'basic',
            'date' => '2026-07-03T12:00:00',
            'lang' => 'en',
            'translations' => ['en' => 10, 'pt-br' => 11],
            'link' => 'https://account.example.test/product/basic/',
            'title' => ['rendered' => 'Basic fallback'],
        ];
        $productDetails = [
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
                    'options' => ['2 Gb'],
                    'visible' => true,
                ],
                [
                    'name' => 'pricing_card_colors',
                    'options' => ['background:#EBF7F2', 'button_text:#FFFFFF'],
                    'visible' => true,
                ],
            ],
        ];
        $authenticatedProductDetails = [];
        $wordPressLanguages = [
            (object) ['slug' => 'en', 'w3c' => 'en-US'],
        ];

        $result = $this->transformer->mapProduct(
            $fromApi,
            $productDetails,
            $authenticatedProductDetails,
            $wordPressLanguages,
        );

        self::assertSame('Basic', $result['title']);
        self::assertSame('10-11', $result['translationGroup']);
        self::assertSame('R$ 55,00', $result['price']);
        self::assertTrue($result['hasPriceRange']);
        self::assertSame('en-US', $result['lang']);
        self::assertSame('<p>Short description</p>', $result['description']);
        self::assertSame([
            'background' => '#EBF7F2',
            'button_text' => '#FFFFFF',
        ], $result['pricingCardColors']);
        self::assertSame([
            [
                'name' => 'Storage',
                'values' => ['2 Gb'],
                'visible' => true,
            ],
            [
                'name' => 'pricing_card_colors',
                'values' => ['background:#EBF7F2', 'button_text:#FFFFFF'],
                'visible' => true,
            ],
        ], $result['attributes']);
    }

    public function testMapProductHandlesProductsWithoutLanguageMetadata(): void
    {
        $fromApi = self::wpProduct([
            'id' => 21,
            'slug' => 'starter',
            'link' => 'https://account.example.test/product/starter/',
            'title' => ['rendered' => 'Starter fallback'],
            'lang' => null,
        ]);
        $fromApi['translations'] = [];
        unset($fromApi['lang']);

        $productDetails = self::storeProduct([
            'name' => 'Starter',
            'short_description' => '<p>Starter description</p>',
            'permalink' => 'https://account.example.test/product/starter/',
            'prices' => self::prices([
                'currency_prefix' => '$',
                'currency_suffix' => '',
                'currency_decimal_separator' => '.',
                'currency_thousand_separator' => ',',
                'price' => '2900',
            ]),
            'attributes' => [],
        ]);

        $result = $this->transformer->mapProduct(
            $fromApi,
            $productDetails,
            [],
            [],
        );

        self::assertSame('Starter', $result['title']);
        self::assertSame('$29.00', $result['price']);
        self::assertNull($result['lang']);
        self::assertNull($result['langSlug']);
        self::assertSame('21', $result['translationGroup']);
    }

    #[DataProvider('authenticatedAttributeMergeProvider')]
    public function testAuthenticatedAttributesAreMerged(
        array $publicAttributes,
        array $authenticatedAttributes,
        array $expectedAttributes,
    ): void
    {
        $fromApi = self::wpProduct([
            'id' => 99,
            'slug' => 'plus',
            'title' => ['rendered' => 'Plus fallback'],
            'link' => 'https://account.example.test/product/plus/',
            'translations' => ['en' => 99],
        ]);

        $publicProductDetails = self::storeProduct([
            'name' => 'Plus',
            'short_description' => '<p>Public description</p>',
            'permalink' => 'https://account.example.test/product/plus/',
            'prices' => self::prices([
                'currency_prefix' => '$',
                'currency_decimal_separator' => '.',
                'currency_thousand_separator' => ',',
                'price' => '4900',
            ]),
            'attributes' => $publicAttributes,
        ]);

        $authenticatedEnrichment = [
            'attributes' => $authenticatedAttributes,
        ];

        $result = $this->transformer->mapProduct(
            $fromApi,
            $publicProductDetails,
            $authenticatedEnrichment,
            []
        );

        self::assertSame($expectedAttributes, $result['attributes']);
    }

    public static function authenticatedAttributeMergeProvider(): iterable
    {
        yield 'authenticated attribute overrides matching public attribute' => [
            [
                self::attribute('Storage', ['2 Gb']),
            ],
            [
                self::attribute('Storage', ['20 Gb']),
            ],
            [
                self::normalizedAttribute('Storage', ['20 Gb']),
            ],
        ];

        yield 'public-only attributes are preserved when auth provides subset' => [
            [
                self::attribute('Storage', ['2 Gb']),
                self::attribute('Support', ['Email']),
            ],
            [
                self::attribute('Storage', ['20 Gb']),
            ],
            [
                self::normalizedAttribute('Storage', ['20 Gb']),
                self::normalizedAttribute('Support', ['Email']),
            ],
        ];

        yield 'authenticated-only attributes are appended to public set' => [
            [
                self::attribute('Storage', ['2 Gb']),
            ],
            [
                self::attribute('Storage', ['20 Gb']),
                self::attribute('pricing_card_colors', ['background:#EBF7F2']),
            ],
            [
                self::normalizedAttribute('Storage', ['20 Gb']),
                self::normalizedAttribute('pricing_card_colors', ['background:#EBF7F2']),
            ],
        ];

        yield 'attribute names are normalized before matching and duplicates are avoided' => [
            [
                self::attribute('Storage', ['2 GB']),
                self::attribute('pricing_card_colors', ['background:#EBF7F2']),
            ],
            [
                self::attribute(' storage ', ['20 GB']),
                self::attribute('Pricing Card Colors', ['background:#00A86B']),
            ],
            [
                self::normalizedAttribute(' storage ', ['20 GB']),
                self::normalizedAttribute('Pricing Card Colors', ['background:#00A86B']),
            ],
        ];

        yield 'empty authenticated attributes preserve all public attributes' => [
            [
                self::attribute('Storage', ['2 Gb']),
                self::attribute('Support', ['Community']),
            ],
            [],
            [
                self::normalizedAttribute('Storage', ['2 Gb']),
                self::normalizedAttribute('Support', ['Community']),
            ],
        ];

        yield 'explicit empty authenticated attribute entries preserve public attributes' => [
            [
                self::attribute('Storage', ['2 Gb']),
            ],
            [
                [
                    'name' => 'Storage',
                    'attributes' => [],
                ],
            ],
            [
                self::normalizedAttribute('Storage', ['2 Gb']),
            ],
        ];
    }

    public function testMapProductFallsBackToSafeDefaultsWhenPublicDetailsAreMissing(): void
    {
        $fromApi = self::wpProduct([
            'id' => 501,
            'slug' => 'fallback-plan',
            'link' => 'https://account.example.test/product/fallback-plan/',
            'title' => ['rendered' => 'Fallback Plan'],
            'lang' => null,
        ]);
        $fromApi['translations'] = [];
        unset($fromApi['lang']);

        $result = $this->transformer->mapProduct(
            $fromApi,
            [],
            [],
            []
        );

        self::assertSame('Fallback Plan', $result['title']);
        self::assertSame('fallback-plan', $result['slug']);
        self::assertNull($result['price']);
        self::assertSame('', $result['description']);
        self::assertSame('https://account.example.test/product/fallback-plan/', $result['permalink']);
        self::assertSame('View product', $result['buttonLabel']);
        self::assertSame([], $result['attributes']);
        self::assertSame([], $result['pricingCardColors']);
    }

    private static function wpProduct(array $overrides = []): array
    {
        return self::mergeRecursiveDistinct([
            'id' => 10,
            'slug' => 'basic',
            'date' => '2026-07-08T12:00:00',
            'lang' => 'en',
            'translations' => ['en' => 10],
            'link' => 'https://account.example.test/product/basic/',
            'title' => ['rendered' => 'Basic fallback'],
        ], $overrides);
    }

    private static function storeProduct(array $overrides = []): array
    {
        return self::mergeRecursiveDistinct([
            'name' => 'Basic',
            'short_description' => '<p>Short description</p>',
            'permalink' => 'https://account.example.test/product/basic/',
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

    private static function normalizedAttribute(string $name, array $values, bool $visible = true): array
    {
        return [
            'name' => $name,
            'values' => $values,
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

