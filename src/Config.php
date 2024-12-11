<?php

declare(strict_types=1);

namespace Serhii\Ago;

final class Config
{
    public string $lang;

    /**
     * Overwrite default translations with provided translations.
     *
     * @var LangOverwrite[]
     */
    public array $overwrites;

    public readonly bool $hasCustomLang;
    public readonly bool $hasCustomOverwrites;

    /**
     * @see https://en.wikipedia.org/wiki/List_of_ISO_639_language_codes
     *
     * @param string|null $lang Use ISO 639-1 language code.
     * Default is English (Lang::EN).
     *
     * @param LangOverwrite[]|null $overwrites Overwrite default
     * translations.
     */
    public function __construct(string|null $lang = null, array|null $overwrites = null)
    {
        $this->lang = $lang ?? Lang::EN;
        $this->hasCustomLang = $lang !== null;
        $this->overwrites = $overwrites ?? [];
        $this->hasCustomOverwrites = $overwrites !== null;
    }
}
