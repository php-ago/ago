<?php

declare(strict_types=1);

namespace Serhii\Ago\Loader;

use RuntimeException;

final readonly class LangLoader
{
    public function __construct(private string $langDir)
    {
    }

    /**
     * Loads translations for the given language from the
     * language directory.
     *
     * @return array<string,string|array<string,string>>
     */
    public function load(string $lang): array
    {
        $path = "{$this->langDir}/{$lang}.php";

        if (!file_exists($path)) {
            throw new RuntimeException("[Ago]: Translation file not found for language: {$lang}");
        }

        return require $path;
    }
}
