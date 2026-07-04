<?php

declare(strict_types=1);

namespace Tests\Unit\Support\Pricing;

use App\Support\Pricing\PricingPageBuilder;
use Illuminate\Support\Collection;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class PricingPageBuilderTest extends TestCase
{
    private PricingPageBuilder $builder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->builder = new PricingPageBuilder();
    }

    #[DataProvider('productOrderingProvider')]
    public function testBuildOrdersProductsUsingExpectedPriorityRules(array $products, array $expectedOrder): void
    {
        $viewModel = $this->builder->build($this->makeProducts($products), 'en-US', 'en-US');

        self::assertSame(
            $expectedOrder,
            $viewModel['productEntries']->map(fn (array $entry) => $entry['product']->title)->all(),
        );
    }

    public static function productOrderingProvider(): iterable
    {
        yield 'storage capacity takes precedence' => [
            [
                [
                    'id' => 2,
                    'title' => 'Professional',
                    'date' => 200,
                    'attributes' => [
                        ['name' => 'Storage', 'values' => ['120 Gb']],
                        ['name' => 'LibreSign features', 'values' => ['Legally valid signatures']],
                        ['name' => 'Available features', 'values' => ['Forms']],
                    ],
                ],
                [
                    'id' => 3,
                    'title' => 'Enterprise',
                    'date' => 300,
                    'attributes' => [
                        ['name' => 'Storage', 'values' => ['800 Gb']],
                        ['name' => 'LibreSign features', 'values' => ['Legally valid signatures']],
                        ['name' => 'Available features', 'values' => ['Forms', 'Video conference']],
                    ],
                ],
                [
                    'id' => 1,
                    'title' => 'Basic',
                    'date' => 100,
                    'attributes' => [
                        ['name' => 'Storage', 'values' => ['2 Gb']],
                        ['name' => 'LibreSign features', 'values' => ['Legally valid signatures']],
                    ],
                ],
            ],
            ['Basic', 'Professional', 'Enterprise'],
        ];

        yield 'feature count and date break ties when storage is missing' => [
            [
                [
                    'id' => 10,
                    'title' => 'Advanced',
                    'date' => 300,
                    'attributes' => [
                        ['name' => 'LibreSign features', 'values' => ['A', 'B']],
                    ],
                ],
                [
                    'id' => 11,
                    'title' => 'Starter',
                    'date' => 100,
                    'attributes' => [
                        ['name' => 'LibreSign features', 'values' => ['A']],
                    ],
                ],
                [
                    'id' => 12,
                    'title' => 'Pro',
                    'date' => 200,
                    'attributes' => [
                        ['name' => 'LibreSign features', 'values' => ['A', 'B']],
                    ],
                ],
            ],
            ['Starter', 'Pro', 'Advanced'],
        ];
    }

    public function testBuildCreatesInheritedHighlightsAndDifferentialComparisonRows(): void
    {
        $viewModel = $this->builder->build($this->makeProducts([
            [
                'id' => 1,
                'title' => 'Basic',
                'attributes' => [
                    ['name' => 'Storage', 'values' => ['2 Gb']],
                    ['name' => 'LibreSign features', 'values' => ['Legally valid signatures']],
                ],
            ],
            [
                'id' => 2,
                'title' => 'Professional',
                'attributes' => [
                    ['name' => 'Storage', 'values' => ['120 Gb']],
                    ['name' => 'LibreSign features', 'values' => ['Legally valid signatures']],
                    ['name' => 'Available features', 'values' => ['Forms']],
                ],
            ],
            [
                'id' => 3,
                'title' => 'Enterprise',
                'attributes' => [
                    ['name' => 'Storage', 'values' => ['800 Gb']],
                    ['name' => 'LibreSign features', 'values' => ['Legally valid signatures']],
                    ['name' => 'Available features', 'values' => ['Forms', 'Video conference']],
                ],
            ],
        ]), 'en-US', 'en-US');

        $productEntries = $viewModel['productEntries']->values();

        self::assertSame([
            [
                'type' => 'inherited',
                'label' => 'Everything in %s and more',
                'context' => 'Basic',
            ],
            [
                'type' => 'feature',
                'label' => 'Forms',
            ],
        ], $productEntries[1]['cardHighlights']);

        self::assertSame([
            [
                'type' => 'inherited',
                'label' => 'Everything in %s and more',
                'context' => 'Professional',
            ],
            [
                'type' => 'feature',
                'label' => 'Video conference',
            ],
        ], $productEntries[2]['cardHighlights']);

        $planExtrasGroup = $viewModel['comparisonFeatureGroups']->firstWhere('key', 'plan_apps');

        self::assertNotNull($planExtrasGroup);
        self::assertSame(
            ['Forms', 'Video conference'],
            $planExtrasGroup['rows']->map(fn (array $row) => $row['label'])->all(),
        );
    }

    public function testBuildUsesLocalizedProductAndFallbackAttributes(): void
    {
        $viewModel = $this->builder->build($this->makeProducts([
            [
                'id' => 1,
                'translationGroup' => 'basic-group',
                'title' => 'Basic',
                'lang' => 'en-US',
                'langSlug' => 'en',
                'attributes' => [
                    ['name' => 'Storage', 'values' => ['2 Gb']],
                    ['name' => 'LibreSign features', 'values' => ['Legally valid signatures']],
                ],
            ],
            [
                'id' => 2,
                'translationGroup' => 'basic-group',
                'title' => 'Básico',
                'lang' => 'pt-BR',
                'langSlug' => 'pt-br',
                'attributes' => [],
            ],
        ]), 'pt-BR', 'en-US');

        $entry = $viewModel['productEntries']->first();

        self::assertSame('Básico', $entry['product']->title);
        self::assertSame([
            [
                'name' => 'Storage',
                'values' => ['2 Gb'],
            ],
        ], $entry['detailAttributes']);
        self::assertSame('Storage', $viewModel['detailRows']->first()['label']);
    }

    /**
     * @param list<array<string, mixed>> $products
     */
    private function makeProducts(array $products): Collection
    {
        return collect(array_map(function (array $product): object {
            return (object) array_merge([
                'id' => 0,
                'translationGroup' => null,
                'title' => 'Untitled',
                'slug' => 'untitled',
                'date' => 0,
                'lang' => 'en-US',
                'langSlug' => 'en',
                'attributes' => [],
                'permalink' => '#',
                'pricingCardColors' => [],
            ], $product);
        }, $products));
    }
}
