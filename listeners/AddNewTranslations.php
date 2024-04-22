<?php

namespace App\Listeners;

use TightenCo\Jigsaw\Jigsaw;

class AddNewTranslations
{
    private Jigsaw $jigsaw;
    public function handle(Jigsaw $jigsaw)
    {
        $this->jigsaw = $jigsaw;
        $self = $this;
        $this->jigsaw->getSiteData()->macro('updateTranslation', function(string $currentLanguage, string $text) use ($self) {
            $self->updateTranslation($currentLanguage, $text);
        });
    }

    public function updateTranslation(string $currentLanguage, string $text) {
        // Save new texts
        $translationFile = 'lang/' . $currentLanguage . '/main.json';
        if (!is_dir('lang/' . $currentLanguage)) {
            mkdir('lang/' . $currentLanguage);
        }
        $localization = $this->jigsaw->getSiteData()->localization;
        if (empty($localization[$currentLanguage][$text])) {
            if (file_exists($translationFile)) {
                $content = file_get_contents($translationFile);
                $content = json_decode($content, true);
            } else {
                $content = [];
            }
            $content[$text] = '';
            ksort($content);
            file_put_contents($translationFile, json_encode($content, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
        }
        // Store translated texts to be possible update translation files
        if (!file_exists('lang/to_translate.json')) {
            file_put_contents('lang/to_translate.json', '[]');
        }
        $toTranslate = file_get_contents('lang/to_translate.json');
        $toTranslate = json_decode($toTranslate, true);
        $toTranslate[$text] = '';
        ksort($toTranslate);
        file_put_contents('lang/to_translate.json', json_encode($toTranslate, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) . PHP_EOL);
    }
}
