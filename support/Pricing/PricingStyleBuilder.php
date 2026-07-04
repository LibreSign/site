<?php

declare(strict_types=1);

namespace App\Support\Pricing;

use Illuminate\Support\Collection;

final class PricingStyleBuilder
{
    /**
     * @return array<string, string>
     */
    public function defaultPricingCardColors(): array
    {
        return [
            'background' => '#FFFFFF',
            'surface' => '#F7FAF8',
            'border' => '#E5E9E7',
            'heading' => '#1A1A1A',
            'price' => '#1A1A1A',
            'text' => '#4A4A4A',
            'muted' => '#717171',
            'accent' => '#1D9E75',
            'check' => '#1D9E75',
            'button_background' => '#FFFFFF',
            'button_text' => '#0F6E56',
            'button_border' => '#0F6E56',
        ];
    }

    /**
     * @param array<string, string|null> $pricingCardColors
     */
    public function buildCardStyle(array $pricingCardColors): string
    {
        $resolvedColors = $this->mergePricingCardColors($pricingCardColors);

        return $this->buildCssVariables([
            '--pricing-card-bg' => $pricingCardColors['background'] ?? $resolvedColors['background'] ?? null,
            '--pricing-card-surface' => $pricingCardColors['surface']
                ?? ($pricingCardColors['background'] ?? null)
                ?? $resolvedColors['surface']
                ?? ($resolvedColors['background'] ?? null),
            '--pricing-card-border' => $pricingCardColors['border'] ?? $resolvedColors['border'] ?? null,
            '--pricing-card-heading' => $pricingCardColors['heading']
                ?? ($pricingCardColors['text'] ?? null)
                ?? $resolvedColors['heading']
                ?? ($resolvedColors['text'] ?? null),
            '--pricing-card-price' => $pricingCardColors['price']
                ?? ($pricingCardColors['heading'] ?? null)
                ?? $resolvedColors['price']
                ?? ($resolvedColors['heading'] ?? null),
            '--pricing-card-text' => $pricingCardColors['text'] ?? $resolvedColors['text'] ?? null,
            '--pricing-card-muted' => $pricingCardColors['muted'] ?? $resolvedColors['muted'] ?? null,
            '--pricing-card-accent' => $pricingCardColors['accent'] ?? $resolvedColors['accent'] ?? null,
            '--pricing-card-check' => $pricingCardColors['check']
                ?? ($pricingCardColors['accent'] ?? null)
                ?? $resolvedColors['check']
                ?? ($resolvedColors['accent'] ?? null),
            '--pricing-card-button-bg' => $pricingCardColors['button_background'] ?? $resolvedColors['button_background'] ?? null,
            '--pricing-card-button-text' => $pricingCardColors['button_text'] ?? $resolvedColors['button_text'] ?? null,
            '--pricing-card-button-border' => $pricingCardColors['button_border']
                ?? ($pricingCardColors['button_background'] ?? null)
                ?? $resolvedColors['button_border']
                ?? ($resolvedColors['button_background'] ?? null),
        ]);
    }

    /**
     * @param array<string, string|null> $pricingCardColors
     */
    public function buildComparisonHeaderStyle(array $pricingCardColors): string
    {
        $resolvedColors = $this->mergePricingCardColors($pricingCardColors);

        return $this->buildCssVariables([
            '--comparison-plan-bg' => $pricingCardColors['background'] ?? $resolvedColors['background'] ?? null,
            '--comparison-plan-text' => $pricingCardColors['price']
                ?? ($pricingCardColors['heading'] ?? ($pricingCardColors['text'] ?? null))
                ?? $resolvedColors['price']
                ?? ($resolvedColors['heading'] ?? ($resolvedColors['text'] ?? null)),
            '--comparison-plan-border' => $pricingCardColors['border'] ?? $resolvedColors['border'] ?? null,
        ]);
    }

    /**
     * @param array<string, string|null> $pricingCardColors
     * @return array<string, string>
     */
    public function mergePricingCardColors(array $pricingCardColors): array
    {
        return array_merge(
            $this->defaultPricingCardColors(),
            array_filter($pricingCardColors, static fn ($value) => $value !== null && $value !== '')
        );
    }

    /**
     * @param array<string, string|null> $variables
     */
    private function buildCssVariables(array $variables): string
    {
        return Collection::make($variables)
            ->filter(static fn ($value) => $value !== null && $value !== '')
            ->map(static fn ($value, $name) => $name . ': ' . $value)
            ->implode('; ');
    }
}