#!/usr/bin/env php
<?php

declare(strict_types=1);

use App\Support\Fragments\FragmentWebhookPublisher;

require __DIR__ . '/../vendor/autoload.php';

$destinationPath = $argv[1] ?? (__DIR__ . '/../build_production');
$destinationPath = rtrim($destinationPath, '/');

if (! is_dir($destinationPath)) {
    fwrite(STDERR, sprintf("Build directory not found: %s\n", $destinationPath));
    exit(1);
}

$publisher = new FragmentWebhookPublisher();
$secret = trim((string) getenv('LIBRESIGN_FRAGMENT_WEBHOOK_SECRET'));
$deployment = array_filter([
    'source' => 'github-actions',
    'repository' => getenv('GITHUB_REPOSITORY') ?: null,
    'ref' => getenv('GITHUB_REF') ?: null,
    'event' => getenv('GITHUB_EVENT_NAME') ?: null,
    'sha' => getenv('GITHUB_SHA') ?: null,
    'actor' => getenv('GITHUB_ACTOR') ?: null,
    'workflow' => getenv('GITHUB_WORKFLOW') ?: null,
    'run_id' => getenv('GITHUB_RUN_ID') ?: null,
    'run_attempt' => getenv('GITHUB_RUN_ATTEMPT') ?: null,
    'server_url' => getenv('GITHUB_SERVER_URL') ?: null,
    'environment' => 'production',
    'pull_request_number' => getenv('LIBRESIGN_MERGED_PR_NUMBER') ?: null,
    'pull_request_merged_at' => getenv('LIBRESIGN_MERGED_PR_MERGED_AT') ?: null,
    'pull_request_head_ref' => getenv('LIBRESIGN_MERGED_PR_HEAD_REF') ?: null,
], static fn (mixed $value): bool => $value !== null && $value !== '');

$webhooks = [
    'header' => [
        'url' => trim((string) getenv('LIBRESIGN_HEADER_WEBHOOK_URL')),
    ],
    'footer' => [
        'url' => trim((string) getenv('LIBRESIGN_FOOTER_WEBHOOK_URL')),
    ],
];

$totalPublished = 0;

foreach ($webhooks as $fragmentType => $webhook) {
    if ($webhook['url'] === '' || $secret === '') {
        fwrite(STDOUT, sprintf("Skipping %s fragments: webhook URL or shared secret not configured.\n", $fragmentType));
        continue;
    }

    $published = $publisher->publish(
        $fragmentType,
        $destinationPath,
        $webhook['url'],
        $secret,
        $deployment,
    );

    fwrite(STDOUT, sprintf("Published %d %s fragment payload(s).\n", $published, $fragmentType));
    $totalPublished += $published;
}

fwrite(STDOUT, sprintf("Fragment webhook sync complete. Published %d payload(s).\n", $totalPublished));
