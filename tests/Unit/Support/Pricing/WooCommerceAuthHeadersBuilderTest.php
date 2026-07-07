<?php

declare(strict_types=1);

namespace Tests\Unit\Support\Pricing;

use App\Support\Pricing\WooCommerceAuthHeadersBuilder;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class WooCommerceAuthHeadersBuilderTest extends TestCase
{
    private WooCommerceAuthHeadersBuilder $builder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->builder = new WooCommerceAuthHeadersBuilder();
    }

    #[DataProvider('buildProvider')]
    public function testBuild(?string $consumerKey, ?string $consumerSecret, array $expected): void
    {
        self::assertSame($expected, $this->builder->build($consumerKey, $consumerSecret));
    }

    public static function buildProvider(): iterable
    {
        yield 'returns empty when key is missing' => [
            null,
            'secret',
            [],
        ];

        yield 'returns empty when secret is missing' => [
            'key',
            '',
            [],
        ];

        yield 'returns basic auth headers when both credentials are present' => [
            'ck_test',
            'cs_test',
            [
                'Authorization: Basic ' . base64_encode('ck_test:cs_test'),
                'Accept: application/json',
            ],
        ];
    }
}
