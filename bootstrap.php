<?php

use App\Listeners\RemoveTranslationFiles;
use App\Listeners\TranslateContent;
use ElaborateCode\JigsawLocalization\LoadLocalization;

/** @var \Illuminate\Container\Container $container */
/** @var \TightenCo\Jigsaw\Events\EventBus $events */

$events->beforeBuild([
    LoadLocalization::class,
    RemoveTranslationFiles::class,
    TranslateContent::class,
]);


$events->afterBuild(App\Listeners\GenerateSitemap::class);
