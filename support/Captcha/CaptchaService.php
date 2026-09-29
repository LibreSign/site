<?php

declare(strict_types=1);

namespace App\Support\Captcha;

use Gregwar\Captcha\CaptchaBuilder;

class CaptchaService
{
    /**
     * @return array{phrase: string, image: string}
     */
    public function generate(): array
    {
        $builder = new CaptchaBuilder();
        $builder->build();

        $phrase = $builder->getPhrase();

        if (!is_string($phrase) || $phrase === '') {
            throw new \RuntimeException('Failed to generate CAPTCHA phrase.');
        }

        return [
            'phrase' => $phrase,
            'image' => $builder->get(),
        ];
    }

    public function validate(?string $expectedPhrase, ?string $submittedPhrase): bool
    {
        if ($expectedPhrase === null || $expectedPhrase === '' || $submittedPhrase === null) {
            return false;
        }

        return (new CaptchaBuilder($expectedPhrase))->testPhrase($submittedPhrase);
    }
}
