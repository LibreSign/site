<?php

use App\Listeners\TranslateContent;
use ElaborateCode\JigsawLocalization\LoadLocalization;

/** @var \Illuminate\Container\Container $container */
/** @var \TightenCo\Jigsaw\Events\EventBus $events */

$events->beforeBuild([
    LoadLocalization::class,
    TranslateContent::class,
]);
