<?php

declare(strict_types=1);

namespace Tests\Unit\Listeners;

use App\Listeners\TranslateContentHandler;
use Mni\FrontYAML\Parser;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;
use ReflectionProperty;
use TightenCo\Jigsaw\PageData;
use TightenCo\Jigsaw\Parsers\FrontMatterParser;
use TightenCo\Jigsaw\Parsers\MarkdownParser;

final class TranslateContentHandlerTest extends TestCase
{
    #[DataProvider('translatedHeadersProvider')]
    public function testTranslatedFrontMatterRemainsValidYaml(
        string $translatedTitle,
        string $translatedDescription,
    ): void {
        $parser = new FrontMatterParser(new Parser(markdownParser: new MarkdownParser()));
        $page = new class ($translatedTitle, $translatedDescription) {
            public function __construct(
                private string $title,
                private string $description,
            ) {
            }

            public function t(string $source, array $replacements, string $locale): string
            {
                return match ($source) {
                    'English title' => $this->title,
                    'English description' => $this->description,
                    default => $source,
                };
            }
        };
        $handler = new TranslateContentHandler($parser, []);

        (new ReflectionProperty($handler, 'translated'))->setValue(
            $handler,
            "---\ntitle: English title\ndescription: English description\n---\nBody must remain intact.\n",
        );
        (new ReflectionProperty($handler, 'pageData'))->setValue(
            $handler,
            new PageData(['page' => $page]),
        );
        (new ReflectionProperty($handler, 'languageCode'))->setValue($handler, 'fr');

        (new ReflectionMethod($handler, 'translateHeaders'))->invoke($handler);

        $content = (new ReflectionProperty($handler, 'translated'))->getValue($handler);

        self::assertSame(
            ['title' => $translatedTitle, 'description' => $translatedDescription],
            $parser->getFrontMatter($content),
        );
        self::assertStringContainsString("---\nBody must remain intact.\n", $content);
    }

    public static function translatedHeadersProvider(): iterable
    {
        yield 'French title with colon' => [
            'Gestion documentaire dans l’enseignement : défis et solutions avec LibreSign',
            'Un logiciel sûr : comment cela fonctionne',
        ];

        yield 'quotes and apostrophes' => [
            'A "qualified" signature: what it means',
            "L’application d’une règle : c’est important",
        ];

        yield 'YAML special values' => [
            'on',
            '# Private documents',
        ];
    }
}
