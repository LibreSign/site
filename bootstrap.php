<?php

use App\Listeners\AddNewTranslation;
use App\Listeners\RemoveDeletedTranslations;
use App\Listeners\RemoveTranslationFiles;
use App\Listeners\TranslateContent;
use ElaborateCode\JigsawLocalization\LoadLocalization;

/** @var \Illuminate\Container\Container $container */
/** @var \TightenCo\Jigsaw\Events\EventBus $events */

$events->beforeBuild([
    LoadLocalization::class,
    AddNewTranslation::class,
    TranslateContent::class,
]);
$events->afterBuild([
    RemoveDeletedTranslations::class,
    RemoveTranslationFiles::class,
]);