<?php

use App\Listeners\RemoveTranslationFiles;
use App\Listeners\TranslateContent;
use ElaborateCode\JigsawLocalization\LoadLocalization;

/** @var \Illuminate\Container\Container $container */
/** @var \TightenCo\Jigsaw\Events\EventBus $events */

$events->beforeBuild([
    LoadLocalization::class,
    TranslateContent::class,
]);


$events->afterBuild([
    RemoveTranslationFiles::class,
    App\Listeners\GenerateSitemap::class,
    App\Listeners\CleanupCollectionDirectories::class,
    App\Listeners\PushHeaderFragments::class,
    App\Listeners\PushFooterFragments::class,
]);
