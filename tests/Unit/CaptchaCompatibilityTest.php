<?php

declare(strict_types=1);

namespace Tests\Unit;

use Gregwar\Captcha\CaptchaBuilder;
use PHPUnit\Framework\TestCase;

class CaptchaCompatibilityTest extends TestCase
{
    public function testCaptchaCanBeBuiltAndOutputWithVersionTwoApi(): void
    {
        $builder = new CaptchaBuilder();
        $builder->build();

        $phrase = $builder->getPhrase();

        self::assertIsString($phrase);
        self::assertNotSame('', $phrase);

        ob_start();
        $builder->output();
        $image = ob_get_clean();

        self::assertIsString($image);
        self::assertNotSame('', $image);
        self::assertStringStartsWith("\xFF\xD8\xFF", $image);
    }

    public function testCaptchaPhraseValidationStillWorks(): void
    {
        $builder = new CaptchaBuilder('AbC123');

        self::assertTrue($builder->testPhrase('abc123'));
        self::assertFalse($builder->testPhrase('wrong'));
    }
}
