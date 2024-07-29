<?php

namespace App\Listeners;

use TightenCo\Jigsaw\Jigsaw;

class RemoveDeletedTranslations
{
    public function handle(Jigsaw $jigsaw)
    {
        if (!file_exists('lang/to_translate.json')) {
            return;
        }
        $toTranslate = file_get_contents('lang/to_translate.json');
        $toTranslate = json_decode($toTranslate, true);
        foreach(glob('lang/*') as $path) {
            $langFile = $path . '/main.json';
            if (is_dir($path) && file_exists($langFile)) {
                $translated = file_get_contents($langFile);
                $translated = json_decode($translated, true);
                foreach (array_keys($translated) as $text) {
                    if (!array_key_exists($text, $toTranslate)) {
                        unset($translated[$text]);
                    }
                }
                file_put_contents($langFile, json_encode($translated, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT) . PHP_EOL);
            }
        }
        unlink('lang/to_translate.json');
    }
}
