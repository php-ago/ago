<?php

declare(strict_types=1);

namespace Serhii\Ago\Loader;

use RuntimeException;
use Serhii\Ago\LangSet;

final class LangLoader
{
    public function __construct(private readonly string $langDir)
    {
    }

    /**
     * Loads translations for the given language from the
     * language directory.
     */
    public function load(string $lang): LangSet
    {
        $path = "{$this->langDir}/{$lang}.php";

        if (!file_exists($path)) {
            throw new RuntimeException("[Ago]: Translation file not found for language: {$lang}");
        }

        $langSet = require $path;

        if (!$langSet instanceof LangSet) {
            throw new RuntimeException("[Ago]: File '{$path}' must return an instance of LangSet");
        }

        return $langSet;
    }
}
