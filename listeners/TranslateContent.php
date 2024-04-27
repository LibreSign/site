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
        $prepareTranslationFiles = new PrepareTranslationFiles();
        $prepareTranslationFiles->handle($jigsaw);
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
