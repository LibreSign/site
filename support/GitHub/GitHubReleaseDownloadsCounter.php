<?php

declare(strict_types=1);

namespace App\Support\GitHub;

class GitHubReleaseDownloadsCounter
{
    public function __construct(
        private readonly string $repository = 'LibreSign/libresign',
        private readonly int $timeout = 15,
    ) {
    }

    public function count(?string $token = null): ?int
    {
        $total = 0;
        $page = 1;

        while (true) {
            $releases = $this->fetchPage($page, $token);

            if (empty($releases)) {
                break;
            }

            foreach ($releases as $release) {
                foreach ($release['assets'] ?? [] as $asset) {
                    $total += $asset['download_count'] ?? 0;
                }
            }

            if (count($releases) < 100) {
                break;
            }

            $page++;
        }

        return $total > 0 ? $total : null;
    }

    protected function fetchPage(int $page, ?string $token): ?array
    {
        $headers = ['User-Agent: libresign-site-build'];
        if (!empty($token)) {
            $headers[] = 'Authorization: Bearer ' . $token;
        }

        $context = stream_context_create([
            'http' => [
                'header' => implode("\r\n", $headers),
                'timeout' => $this->timeout,
            ],
        ]);

        $url = sprintf(
            'https://api.github.com/repos/%s/releases?per_page=100&page=%d',
            $this->repository,
            $page,
        );

        $json = @file_get_contents($url, false, $context);

        return $json ? (json_decode($json, true) ?: null) : null;
    }
}
