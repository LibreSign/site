<?php

namespace App\Listeners;

use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\Parsers\FrontMatterParser;
use TightenCo\Jigsaw\SiteBuilder;

class TranslateContent
{
    private Jigsaw $jigsaw;
    public function handle(Jigsaw $jigsaw)
    {
        $this->jigsaw = $jigsaw;
        $this->registerTranslateContentHandler();
        $this->addTranslateFunction();
        $this->addPrepareTranslationFilesHandler();
        $this->addNewTranslationHandler();
        $this->addAfterBuild();
    }

    private function addPrepareTranslationFilesHandler(): void
    {
        $prepareTranslationFiles = new PrepareTranslationFiles();
        $prepareTranslationFiles->handle($this->jigsaw);
    }

    private function addNewTranslationHandler(): void
    {
        $addNewTranslation = new AddNewTranslation();
        $addNewTranslation->handle($this->jigsaw);
    }

    private function addTranslateFunction(): void
    {
        $this->jigsaw->getSiteData()->page->set('t', function ($page, string $text, ?string $current_locale = null): string {
            $current_locale = $current_locale ?? current_path_locale($page);
            $page::addNewTranslation($current_locale, $text);
            if ($translated = __($page, $text, $current_locale)) {
                return $translated;
            }
            return $text;
        });
    }

    private function addAfterBuild(): void
    {
        $this->jigsaw->app->events->afterBuild([
            RemoveDeletedTranslations::class,
            RemoveTranslationFiles::class,
        ]);
    }

    private function getSiteBuilder(): SiteBuilder
    {
        $reflection = new \ReflectionClass($this->jigsaw);
        $reflectionProperty = $reflection->getProperty('siteBuilder');
        $reflectionProperty->setAccessible(true);
        return $reflectionProperty->getValue($this->jigsaw);
    }

    private function registerTranslateContentHandler(): void
    {
        $siteBuilder = $this->getSiteBuilder();

        $reflection = new \ReflectionClass($siteBuilder);
        $reflectionProperty = $reflection->getProperty('handlers');
        $reflectionProperty->setAccessible(true);
        $handlers = $reflectionProperty->getValue($siteBuilder);

        $TranslateContentHandler = new TranslateContentHandler(
            $this->jigsaw->app[FrontMatterParser::class],
            $handlers,
        );

        $reflectionProperty->setValue($siteBuilder, [
            $TranslateContentHandler,
        ]);
    }
}
