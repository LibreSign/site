<?php

namespace App\Listeners;

use TightenCo\Jigsaw\Jigsaw;

/**
 * afterBuild listener that persists extracted strings to lang/{defaultLocale}/main.json.
 *
 * Only does work when JIGSAW_EXTRACT_STRINGS=1 is set.
 * Delegates to AddNewTranslation which holds the in-memory collection of
 * all strings encountered during the build.
 */
class PersistExtractedStrings
{
    public function handle(Jigsaw $jigsaw): void
    {
        (new AddNewTranslation())->persistExtractedStrings();
    }
}
