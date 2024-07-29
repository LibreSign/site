<?php

namespace App\Listeners;

use Illuminate\Support\Collection;
use TightenCo\Jigsaw\Jigsaw;

class AddNewTranslation
{
    private Jigsaw $jigsaw;
    private Collection $localization;
    private string $currentLanguage;
    public function handle(Jigsaw $jigsaw)
    {
        $this->jigsaw = $jigsaw;
        $self = $this;
        $this->jigsaw->getSiteData()->macro('addNewTranslation', function(string $currentLanguage, string $text) use ($self) {
            $self->addNewTranslation($currentLanguage, $text);
        });
    }

    public function addNewTranslation(string $currentLanguage, string $text) {
        $this->localization = $this->jigsaw->getSiteData()->localization;
        $this->currentLanguage = $currentLanguage;
        if (!is_dir('lang/' . $this->currentLanguage)) {
            mkdir('lang/' . $this->currentLanguage);
        }
        // Don't translate tranlated text
        if ($this->isTranslatedText($text)) {
            return;
        }
        $this->storeAtGlossaryFile($text);
        $this->storeAtTranslationFile($text);
    }

    private function isTranslatedText(string $text): bool
    {
        if ($this->localization[$this->currentLanguage]->has($text)) {
            return false;
        }
        return $this->localization[$this->currentLanguage]->contains($text);
    }

    private function storeAtTranslationFile(string $text): void
    {
        // Only change the file if haven't the text
        if ($this->localization[$this->currentLanguage]->has($text)) {
            if ($this->localization[$this->currentLanguage]->get($text) !== $text) {
                return;
            }
        }
        // Save new texts
        $translationFile = 'lang/' . $this->currentLanguage . '/main.json';
        if (file_exists($translationFile)) {
            $content = file_get_contents($translationFile);
            $content = json_decode($content, true);
        } else {
            $content = [];
        }
        $content[$text] = '';
        ksort($content);
        file_put_contents($translationFile, json_encode($content, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));
    }

    private function storeAtGlossaryFile(string $text): void
    {
        // Store translated texts to be possible update translation files
        if (file_exists('lang/to_translate.json')) {
            $toTranslate = file_get_contents('lang/to_translate.json');
            $toTranslate = json_decode($toTranslate, true);
        } else {
            $toTranslate = [];
        }
        $toTranslate[$text] = '';
        ksort($toTranslate);
        file_put_contents('lang/to_translate.json', json_encode($toTranslate, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT) . PHP_EOL);
    }
}
