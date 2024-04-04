<?php

use App\Listeners\RemoveDeletedTranslations;
use TightenCo\Jigsaw\Jigsaw;
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
]);
$events->afterBuild([RemoveDeletedTranslations::class]);