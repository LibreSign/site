<?php

declare(strict_types=1);

namespace Tests\Unit\Listeners;

use App\Listeners\TranslateContentHandler;
use Mni\FrontYAML\Parser;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use TightenCo\Jigsaw\File\InputFile;
use TightenCo\Jigsaw\PageData;
use TightenCo\Jigsaw\PageVariable;
use TightenCo\Jigsaw\Parsers\FrontMatterParser;
use TightenCo\Jigsaw\Parsers\MarkdownParser;

final class TranslateContentHandlerTest extends TestCase
{
    #[DataProvider('translatedHeadersProvider')]
    public function testTranslatedHeadersRemainValidYaml(string $title, string $description): void
    {
        $parser = new FrontMatterParser(new Parser(markdownParser: new MarkdownParser()));
        $listener = new TranslateContentHandler($parser, []);
        $page = new PageVariable([
            't' => static fn ($page, string $source, array $parameters, ?string $locale): string => match ($source) {
                'English title' => $title,
                'English description' => $description,
                default => $source,
            },
        ]);

        $reflection = new \ReflectionClass($listener);
        $reflection->getProperty('pageData')->setValue($listener, new PageData(['page' => $page]));
        $reflection->getProperty('languageCode')->setValue($listener, 'fr');
        $reflection->getProperty('translated')->setValue(
            $listener,
            "---\ntitle: English title\ndescription: English description\noriginal_title: English title\n---\nBody text.\n",
        );

        $reflection->getMethod('translateHeaders')->invoke($listener);

        $output = $reflection->getProperty('translated')->getValue($listener);
        $frontMatter = $parser->getFrontMatter($output);

        self::assertSame($title, $frontMatter['title']);
        self::assertSame($description, $frontMatter['description']);
        self::assertSame('English title', $frontMatter['original_title']);
        self::assertStringEndsWith("---\nBody text.\n", $output);
    }

    #[DataProvider('translatedContentProvider')]
    public function testTranslatedContentCannotInjectTemplateCode(string $filename, string $translatedBody, string $expectedBody): void
    {
        $parser = new FrontMatterParser(new Parser(markdownParser: new MarkdownParser()));
        $listener = new TranslateContentHandler($parser, []);
        $page = new PageVariable([
            't' => static fn ($page, string $source, array $parameters, ?string $locale): string => $translatedBody,
        ]);

        $reflection = new \ReflectionClass($listener);
        $reflection->getProperty('file')->setValue($listener, new InputFile(new \SplFileInfo('/posts/' . $filename)));
        $reflection->getProperty('pageData')->setValue($listener, new PageData(['page' => $page]));
        $reflection->getProperty('languageCode')->setValue($listener, 'fr');
        $reflection->getProperty('translated')->setValue($listener, "---\ntitle: English title\n---\nEnglish body.\n");

        $reflection->getMethod('translateContent')->invoke($listener);

        self::assertSame(
            "---\ntitle: English title\n---\n" . $expectedBody,
            $reflection->getProperty('translated')->getValue($listener),
        );
    }

    public static function translatedContentProvider(): iterable
    {
        yield 'Blade echo in Blade post' => [
            'fr_post.blade.md',
            "Texte {{ 7*7 }}\n",
            "Texte @{{ 7*7 }}\n",
        ];

        yield 'raw Blade echo in Blade post' => [
            'fr_post.blade.md',
            "Texte {!! 7*7 !!}\n",
            "Texte @{!! 7*7 !!}\n",
        ];

        yield 'Blade directive in Blade post' => [
            'fr_post.blade.md',
            "Texte\n@php echo 7*7; @endphp\n",
            "Texte\n{{'@'}}php echo 7*7; {{'@'}}endphp\n",
        ];

        yield 'PHP short echo tag in Blade post' => [
            'fr_post.blade.md',
            "Texte\n<?= 7*7 ?>\n",
            "Texte\n&lt;?= 7*7 ?>\n",
        ];

        yield 'base URL echo kept in Blade post' => [
            'fr_post.blade.md',
            '<img src="{{ $page->baseUrl}}assets/image.png"> contato@librecode.coop' . "\n",
            '<img src="{{ $page->baseUrl }}assets/image.png"> contato{{\'@\'}}librecode.coop' . "\n",
        ];

        yield 'PHP short echo tag in Markdown post' => [
            'fr_post.md',
            "Texte\n<?= 7*7 ?>\n",
            "Texte\n&lt;?= 7*7 ?>\n",
        ];

        yield 'Blade directive after brace in Markdown post' => [
            'fr_post.md',
            "Texte {@php(print(7*7))}\n",
            "Texte {&#64;php(print(7*7))}\n",
        ];

        yield 'Blade component tag in Markdown post' => [
            'fr_post.md',
            "<x-dynamic-component :component=\"print(7*7)\" /></x-dynamic-component>\n",
            "&lt;x-dynamic-component :component=\"print(7*7)\" />&lt;/x-dynamic-component>\n",
        ];

        yield 'Markdown post left for the Markdown handler to escape' => [
            'fr_post.md',
            "Texte {{ 7*7 }} contato@librecode.coop\n",
            "Texte {{ 7*7 }} contato@librecode.coop\n",
        ];
    }

    public static function translatedHeadersProvider(): iterable
    {
        yield 'French SEO title with colon' => [
            'Gestion documentaire dans l’enseignement : défis et solutions avec LibreSign',
            'Une présentation de LibreSign pour les établissements scolaires.',
        ];

        yield 'quotation marks and hash symbol' => [
            'L’équipe « LibreSign » : un projet libre',
            'L’accès "avancé" : sécurisé #1',
        ];

        yield 'YAML scalar-like values' => ['true', 'null'];

        yield 'multiline description' => [
            'Présentation',
            "Première ligne : une valeur\nDeuxième ligne avec #symbole",
        ];

        yield 'ordinary French text' => [
            'Gestion documentaire',
            'Signature électronique pour Nextcloud',
        ];
    }
}
