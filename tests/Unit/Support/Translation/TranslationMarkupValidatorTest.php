<?php

declare(strict_types=1);

namespace Tests\Unit\Support\Translation;

use App\Support\Translation\TranslationMarkupValidator;
use PHPUnit\Framework\TestCase;

final class TranslationMarkupValidatorTest extends TestCase
{
    public function testAcceptsTranslationWithSameMarkup(): void
    {
        $source = "Code on <a href=\"https://github.com/LibreSign/libresign\">GitHub</a>.\n\n<div style=\"text-align: center;\">\n  <img src=\"image.png\" alt=\"Settings\">\n</div>";
        $translation = "Código no <a href=\"https://github.com/LibreSign/libresign\">GitHub</a>.\n\n<div style=\"text-align: center;\">\n  <img src=\"image.png\" alt=\"Configurações\">\n</div>";

        self::assertSame([], (new TranslationMarkupValidator())->validate([$source => $source], [$source => $translation]));
    }

    public function testRejectsTagMissingFromSource(): void
    {
        $source = "## Post title\n\nPost body.";
        $translation = "## Titre\n\nTexte <img src=x>";

        self::assertSame(
            ['HTML markup mismatch in translation of "## Post title": expected [], got [img, img[src]].'],
            (new TranslationMarkupValidator())->validate([$source => $source], [$source => $translation]),
        );
    }

    public function testRejectsAttributeMissingFromSource(): void
    {
        $source = 'See <a href="https://libresign.coop">the site</a>.';
        $translation = 'Voir <a href="https://libresign.coop" onclick="alert(1)">le site</a>.';

        self::assertSame(
            ['HTML markup mismatch in translation of "See <a href="https://libresign.coop">the site</a>.": expected [a, a[href]], got [a, a[href], a[onclick]].'],
            (new TranslationMarkupValidator())->validate([$source => $source], [$source => $translation]),
        );
    }

    public function testIgnoresKeysMissingFromSource(): void
    {
        self::assertSame([], (new TranslationMarkupValidator())->validate([], ['Removed' => '<script>']));
    }
}
