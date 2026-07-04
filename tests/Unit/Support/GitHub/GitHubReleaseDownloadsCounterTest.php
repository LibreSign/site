<?php

declare(strict_types=1);

namespace Tests\Unit\Support\GitHub;

use App\Support\GitHub\GitHubReleaseDownloadsCounter;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class GitHubReleaseDownloadsCounterTest extends TestCase
{
    #[DataProvider('countProvider')]
    public function testCount(array $pages, ?int $expected): void
    {
        $counter = new FakeGitHubReleaseDownloadsCounter($pages);

        self::assertSame($expected, $counter->count('token'));
    }

    public static function countProvider(): iterable
    {
        yield 'returns null when first page fails' => [
            [],
            null,
        ];

        yield 'returns null when releases are empty' => [
            [1 => []],
            null,
        ];

        yield 'sums downloads from a single page' => [
            [
                1 => [
                    ['assets' => [['download_count' => 10], ['download_count' => 5]]],
                    ['assets' => [['download_count' => 7]]],
                ],
            ],
            22,
        ];

        yield 'continues to the second page when first page has 100 items' => [
            [
                1 => array_fill(0, 100, ['assets' => [['download_count' => 1]]]),
                2 => [
                    ['assets' => [['download_count' => 3]]],
                ],
            ],
            103,
        ];
    }
}

final class FakeGitHubReleaseDownloadsCounter extends GitHubReleaseDownloadsCounter
{
    /**
     * @param array<int, array<int, array<string, mixed>>> $pages
     */
    public function __construct(private readonly array $pages)
    {
        parent::__construct();
    }

    protected function fetchPage(int $page, ?string $token): ?array
    {
        return $this->pages[$page] ?? null;
    }
}
