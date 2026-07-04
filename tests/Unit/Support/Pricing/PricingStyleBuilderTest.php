<?php

declare(strict_types=1);

namespace Tests\Unit\Support\Pricing;

use App\Support\Pricing\PricingStyleBuilder;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class PricingStyleBuilderTest extends TestCase
{
    private PricingStyleBuilder $builder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->builder = new PricingStyleBuilder();
    }

    #[DataProvider('mergePricingCardColorsProvider')]
    public function testMergePricingCardColors(array $colors, array $expectedSubset): void
    {
        $merged = $this->builder->mergePricingCardColors($colors);

        foreach ($expectedSubset as $key => $value) {
            self::assertSame($value, $merged[$key]);
        }
    }

    public static function mergePricingCardColorsProvider(): iterable
    {
        yield 'keeps defaults when no custom colors exist' => [
            [],
            [
                'background' => '#FFFFFF',
                'button_text' => '#0F6E56',
            ],
        ];

        yield 'overrides defaults with custom values' => [
            [
                'background' => '#EBF7F2',
                'button_text' => '#FFFFFF',
            ],
            [
                'background' => '#EBF7F2',
                'button_text' => '#FFFFFF',
                'border' => '#E5E9E7',
            ],
        ];
    }

    #[DataProvider('buildCardStyleProvider')]
    public function testBuildCardStyle(array $colors, string $expectedFragment): void
    {
        $style = $this->builder->buildCardStyle($colors);

        self::assertStringContainsString($expectedFragment, $style);
    }

    public static function buildCardStyleProvider(): iterable
    {
        yield 'uses defaults for missing button border' => [
            [
                'background' => '#EBF7F2',
            ],
            '--pricing-card-button-border: #0F6E56',
        ];

        yield 'uses custom surface and text colors' => [
            [
                'surface' => '#D4F0E4',
                'text' => '#1A1A1A',
            ],
            '--pricing-card-surface: #D4F0E4',
        ];

        yield 'uses custom heading as price fallback when custom price is absent' => [
            [
                'heading' => '#0F6E56',
            ],
            '--pricing-card-price: #0F6E56',
        ];
    }

    public function testBuildComparisonHeaderStyleUsesFallbackTextColor(): void
    {
        $style = $this->builder->buildComparisonHeaderStyle([
            'background' => '#EBF7F2',
            'heading' => '#0F6E56',
            'border' => '#D4F0E4',
        ]);

        self::assertStringContainsString('--comparison-plan-bg: #EBF7F2', $style);
        self::assertStringContainsString('--comparison-plan-text: #0F6E56', $style);
        self::assertStringContainsString('--comparison-plan-border: #D4F0E4', $style);
    }
}