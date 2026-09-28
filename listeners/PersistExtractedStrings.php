<?php

namespace App\Listeners;

use TightenCo\Jigsaw\Jigsaw;

/**
 * afterBuild listener that persists extracted strings to lang/{defaultLocale}/main.json.
 *
 * Only does work when JIGSAW_EXTRACT_STRINGS=1 is set.
 */
class PersistExtractedStrings
{
    public function handle(Jigsaw $jigsaw): void
    {
        (new AddNewTranslation())->persistExtractedStrings($jigsaw);
    }
}
