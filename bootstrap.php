<?php

use App\Listeners\AddNewTranslation;
use App\Listeners\PrepareTranslationFiles;
use App\Listeners\RemoveDeletedTranslations;
use App\Listeners\RemoveTranslationFiles;
use App\Listeners\TranslateContent;
use ElaborateCode\JigsawLocalization\LoadLocalization;

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

$events->beforeBuild([
    LoadLocalization::class,
    AddNewTranslation::class,
    TranslateContent::class,
    PrepareTranslationFiles::class,
]);
$events->afterBuild([
    RemoveDeletedTranslations::class,
    RemoveTranslationFiles::class,
]);