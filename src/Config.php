<?php

declare(strict_types=1);

namespace Serhii\Ago;

final class Config
{
    public Lang $lang;

    /**
     * Overwrite default translations with provided translations.
     *
     * @var LangOverwrite[]
     */
    public array $overwrites;

    public readonly bool $hasCustomLang;
    public readonly bool $hasCustomOverwrites;

    /**
     * @param Lang|null $lang Use Lang enum to choose language.
     * Default is English (Lang::EN).
     *
     * @param LangOverwrite[]|null $overwrites Overwrite default
     * translations.
     */
    public function __construct(Lang|null $lang = null, array|null $overwrites = null)
    {
        $this->lang = $lang ?? Lang::EN;
        $this->hasCustomLang = $lang !== null;
        $this->overwrites = $overwrites ?? [];
        $this->hasCustomOverwrites = $overwrites !== null;
    }
}
