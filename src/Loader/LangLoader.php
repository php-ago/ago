<?php

declare(strict_types=1);

namespace Serhii\Ago\Loader;

use RuntimeException;
use Serhii\Ago\Lang;

final class LangLoader
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
    public function load(Lang $lang): array
    {
        $path = "{$this->langDir}/{$lang->value}.php";

        if (!file_exists($path)) {
            throw new RuntimeException("Translation file not found for language: {$lang->value}");
        }

        return require $path;
    }
}
