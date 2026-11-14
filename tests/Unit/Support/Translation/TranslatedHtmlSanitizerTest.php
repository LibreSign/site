<?php

declare(strict_types=1);

namespace Tests\Unit\Support\Translation;

use App\Support\Translation\TranslatedHtmlSanitizer;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class TranslatedHtmlSanitizerTest extends TestCase
{
    #[DataProvider('translatedHtmlProvider')]
    public function testKeepsOnlyBasicMarkup(string $translatedHtml, string $expectedHtml): void
    {
        self::assertSame($expectedHtml, TranslatedHtmlSanitizer::sanitize($translatedHtml));
    }

    public static function translatedHtmlProvider(): iterable
    {
        yield 'HTTPS link' => [
            'Code on <a href="https://github.com/LibreSign/libresign">GitHub</a>.',
            'Code on <a href="https://github.com/LibreSign/libresign">GitHub</a>.',
        ];

        yield 'emphasis' => ['<strong>Yes</strong>, <em>free</em>.', '<strong>Yes</strong>, <em>free</em>.'];

        yield 'image with event handler' => [
            'Oui <img src=x onerror="alert(1)">',
            'Oui &lt;img src=x onerror=&quot;alert(1)&quot;&gt;',
        ];

        yield 'script tag' => ['<script>alert(1)</script>', '&lt;script&gt;alert(1)&lt;/script&gt;'];

        yield 'link with extra attribute' => [
            '<a href="https://example.org" onclick="alert(1)">x</a>',
            '&lt;a href=&quot;https://example.org&quot; onclick=&quot;alert(1)&quot;&gt;x</a>',
        ];

        yield 'javascript link' => [
            '<a href="javascript:alert(1)">x</a>',
            '&lt;a href=&quot;javascript:alert(1)&quot;&gt;x</a>',
        ];

        yield 'existing entity' => ['Q&amp;A', 'Q&amp;A'];
    }
}
