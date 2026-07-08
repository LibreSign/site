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
        $fromApi = [
            'id' => 21,
            'slug' => 'starter',
            'date' => '2026-07-08T12:00:00',
            'translations' => [],
            'link' => 'https://account.example.test/product/starter/',
            'title' => ['rendered' => 'Starter fallback'],
        ];
        $productDetails = [
            'name' => 'Starter',
            'short_description' => '<p>Starter description</p>',
            'permalink' => 'https://account.example.test/product/starter/',
            'type' => 'simple',
            'is_purchasable' => true,
            'has_options' => false,
            'prices' => [
                'currency_prefix' => '$',
                'currency_suffix' => '',
                'currency_minor_unit' => 2,
                'currency_decimal_separator' => '.',
                'currency_thousand_separator' => ',',
                'price' => '2900',
            ],
            'add_to_cart' => [
                'text' => 'View product',
            ],
            'attributes' => [],
        ];

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
}
