<?php

declare(strict_types=1);

namespace Tests\Unit\Support\Translation;

use App\Support\Translation\TranslationTemplateSyntaxValidator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class TranslationTemplateSyntaxValidatorTest extends TestCase
{
    #[DataProvider('rejectedTranslationProvider')]
    public function testRejectsTemplateSyntaxAddedByTranslation(string $source, string $translation, string $expectedError): void
    {
        $errors = (new TranslationTemplateSyntaxValidator())->validate([$source => $source], [$source => $translation]);

        self::assertSame([sprintf('%s in translation of "%s".', $expectedError, $source)], $errors);
    }

    public function testReportsOnlyTheFirstLineOfMultilineKeys(): void
    {
        $source = "## Post title\n\nPost body.";

        $errors = (new TranslationTemplateSyntaxValidator())->validate([$source => $source], [$source => "## Titre\n\n<?= 7*7 ?>"]);

        self::assertSame(['PHP tag in translation of "## Post title".'], $errors);
    }

    public static function rejectedTranslationProvider(): iterable
    {
        yield 'Blade echo' => ['Text', 'Texte {{ 7*7 }}', 'Blade echo other than {{ $page->baseUrl }}'];
        yield 'raw Blade echo' => ['Text', 'Texte {!! 7*7 !!}', 'Unescaped Blade echo'];
        yield 'Blade directive' => ['Text', "Texte\n@php echo 7*7; @endphp", 'Blade directive @php, @endphp'];
        yield 'Blade directive after brace' => ['Text', 'Texte {@php(print(7*7))}', 'Blade directive @php'];
        yield 'PHP short echo tag' => ['Text', "Texte\n<?= 7*7 ?>", 'PHP tag'];
        yield 'Blade component tag' => ['Text', '<x-dynamic-component :component="print(7*7)" />', 'Blade component tag'];
        yield 'missing base URL echo' => [
            '<img src="{{ $page->baseUrl}}image.png">',
            '<img src="image.png">',
            'Base URL echo count differs from source',
        ];
    }

    public function testAcceptsBaseUrlEchoAndEmailAddresses(): void
    {
        $source = '<img src="{{ $page->baseUrl}}image.png"> contact@librecode.coop';
        $translation = '<img src="{{ $page->baseUrl }}image.png"> contato@librecode.coop';

        self::assertSame([], (new TranslationTemplateSyntaxValidator())->validate([$source => $source], [$source => $translation]));
    }

    public function testIgnoresKeysMissingFromSource(): void
    {
        self::assertSame([], (new TranslationTemplateSyntaxValidator())->validate([], ['Removed' => '{{ 7*7 }}']));
    }
}
