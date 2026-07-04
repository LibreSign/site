<?php

declare(strict_types=1);

namespace App\Support\Pricing;

final class WooCommerceAuthHeadersBuilder
{
    /**
     * @return list<string>
     */
    public function build(?string $consumerKey, ?string $consumerSecret): array
    {
        if (empty($consumerKey) || empty($consumerSecret)) {
            return [];
        }

        return [
            'Authorization: Basic ' . base64_encode($consumerKey . ':' . $consumerSecret),
            'Accept: application/json',
        ];
    }
}