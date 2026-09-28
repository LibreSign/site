<?php

declare(strict_types=1);

namespace Tests\Unit\Support;

use App\Support\MarkdownSourceCatalogExtractor;
use Mni\FrontYAML\Parser;
use PHPUnit\Framework\TestCase;
use TightenCo\Jigsaw\Parsers\FrontMatterParser;
use TightenCo\Jigsaw\Parsers\MarkdownParser;

final class MarkdownSourceCatalogExtractorTest extends TestCase
{
    private string $sourcePath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sourcePath = sys_get_temp_dir().'/libresign-i18n-'.bin2hex(random_bytes(6));
        mkdir($this->sourcePath.'/_posts', 0777, true);
        mkdir($this->sourcePath.'/pt-BR', 0777, true);
        mkdir($this->sourcePath.'/_translated_tmp', 0777, true);
    }

    protected function tearDown(): void
    {
        $this->removeDirectory($this->sourcePath);

        parent::tearDown();
    }

    public function testExtractsFrontMatterAndBodyFromCanonicalMarkdownSources(): void
    {
        file_put_contents(
            $this->sourcePath.'/_posts/example.md',
            <<<'MD'
---
title: Example title
description: Example description
---
Example body.
MD
        );

        $catalog = $this->extract();

        self::assertSame('Example title', $catalog['Example title']);
        self::assertSame('Example description', $catalog['Example description']);
        self::assertSame('Example body.', $catalog['Example body.']);
    }

    public function testSupportsBladeMarkdownFiles(): void
    {
        file_put_contents(
            $this->sourcePath.'/_posts/example.blade.md',
            <<<'MD'
---
title: Blade markdown
---
Body with {{ $page->baseUrl }}.
MD
        );

        $catalog = $this->extract();

        self::assertArrayHasKey('Blade markdown', $catalog);
        self::assertArrayHasKey('Body with {{ $page->baseUrl }}.', $catalog);
    }

    public function testIgnoresGeneratedAndLocalizedMarkdownSources(): void
    {
        file_put_contents($this->sourcePath.'/pt-BR/page.md', "---\ntitle: Traduzido\n---\nConteúdo.\n");
        file_put_contents($this->sourcePath.'/_translated_tmp/fr_post.md', "---\ntitle: Traduit\n---\nContenu.\n");
        file_put_contents($this->sourcePath.'/fr_page.md', "---\ntitle: Traduit prefix\n---\nContenu.\n");
        file_put_contents($this->sourcePath.'/page.md', "---\ntitle: Source title\n---\nSource body.\n");

        $catalog = $this->extract();

        self::assertArrayHasKey('Source title', $catalog);
        self::assertArrayHasKey("Source body.\n", $catalog);
        self::assertArrayNotHasKey('Traduzido', $catalog);
        self::assertArrayNotHasKey('Traduit', $catalog);
        self::assertArrayNotHasKey('Traduit prefix', $catalog);
    }

    private function extract(): array
    {
        $parser = new FrontMatterParser(
            new Parser(markdownParser: new MarkdownParser()),
        );

        return (new MarkdownSourceCatalogExtractor())->extract(
            $this->sourcePath,
            'en',
            $parser,
            ['en', 'fr', 'pt-BR'],
        );
    }

    private function removeDirectory(string $path): void
    {
        if (! is_dir($path)) {
            return;
        }

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST,
        );

        foreach ($iterator as $item) {
            if ($item->isDir()) {
                rmdir($item->getPathname());
            } else {
                unlink($item->getPathname());
            }
        }

        rmdir($path);
    }
}
