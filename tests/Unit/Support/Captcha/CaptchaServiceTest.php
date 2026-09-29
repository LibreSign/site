<?php

declare(strict_types=1);

namespace Tests\Unit\Support\Captcha;

use App\Support\Captcha\CaptchaService;
use PHPUnit\Framework\TestCase;

class CaptchaServiceTest extends TestCase
{
    public function testGenerateReturnsPhraseAndJpegImage(): void
    {
        $captcha = (new CaptchaService())->generate();

        self::assertNotSame('', $captcha['phrase']);
        self::assertNotSame('', $captcha['image']);
        self::assertStringStartsWith("\xFF\xD8\xFF", $captcha['image']);
    }

    public function testValidateAcceptsMatchingPhraseCaseInsensitively(): void
    {
        $service = new CaptchaService();

        self::assertTrue($service->validate('AbC123', 'abc123'));
    }

    public function testValidateRejectsInvalidOrMissingInput(): void
    {
        $service = new CaptchaService();

        self::assertFalse($service->validate('AbC123', 'wrong'));
        self::assertFalse($service->validate(null, 'abc123'));
        self::assertFalse($service->validate('', 'abc123'));
        self::assertFalse($service->validate('AbC123', null));
    }
}
