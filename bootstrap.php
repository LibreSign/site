<?php

use TightenCo\Jigsaw\Jigsaw;
use ElaborateCode\JigsawLocalization\LoadLocalization;

$events->beforeBuild([LoadLocalization::class]);

/** @var \Illuminate\Container\Container $container */
/** @var \TightenCo\Jigsaw\Events\EventBus $events */

/*
 * You can run custom code at different stages of the build process by
 * listening to the 'beforeBuild', 'afterCollections', and 'afterBuild' events.
 *
 * For example:
 *
 * $events->beforeBuild(function (Jigsaw $jigsaw) {
 *     // Your code here
 * });
 */

$events->afterBuild(function(Jigsaw $jigsaw) {
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
            file_put_contents($langFile, json_encode($translated, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) . PHP_EOL);
        }
    }
    unlink('lang/to_translate.json');
});