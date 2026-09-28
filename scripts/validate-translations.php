<?php

declare(strict_types=1);

use LibreSign\JigsawLocalization\Catalog\JsonTranslationCatalog;
use LibreSign\JigsawLocalization\Catalog\TranslationCatalogValidator;

require dirname(__DIR__).'/vendor/autoload.php';

$sourceLocale = 'en';
$sourcePath = dirname(__DIR__)."/lang/{$sourceLocale}/main.json";
$source = (new JsonTranslationCatalog($sourcePath))->read();
$validator = new TranslationCatalogValidator();
$errors = [];

if (in_array('--canonical-source', $argv, true)) {
    $errors = $validator->validateCanonicalSource($source);
}

foreach (glob(dirname(__DIR__).'/lang/*/main.json') ?: [] as $translationPath) {
    $locale = basename(dirname($translationPath));

    if ($locale === $sourceLocale) {
        continue;
    }

    $translation = (new JsonTranslationCatalog($translationPath))->read();

    foreach ($validator->validatePlaceholders($source, $translation) as $error) {
        $errors[] = "{$locale}: {$error}";
    }
}

if ($errors === []) {
    fwrite(STDOUT, "Translation catalogs are valid.\n");
    exit(0);
}

foreach ($errors as $error) {
    fwrite(STDERR, $error."\n");
}

exit(1);
