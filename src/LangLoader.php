<?php

declare(strict_types=1);

namespace Serhii\Ago;

use RuntimeException;

class LangLoader
{
    public function __construct(private string $localeDir)
    {
    }

    /**
     * @return array<string,string|array<string,string>>
     */
    public function load(Lang $lang): array
    {
        $path = "{$this->localeDir}/{$lang->value}.php";

        if (!file_exists($path)) {
            throw new RuntimeException("Translation file not found for language: {$lang}");
        }

        return require $path;
    }
}
