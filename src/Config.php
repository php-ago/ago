<?php

declare(strict_types=1);

namespace Serhii\Ago;

class Config
{
    public Lang $lang = Lang::EN;

    /**
     * @var LangOverwrite[]
     */
    public array $overwrites = [];

    /**
     * @param Lang|null $lang Language code ISO 639-1.
     * Default is English (en).
     *
     * @param LangOverwrite[]|null $overwrites Overwrite default
     * translations.
     */
    public function __construct(Lang|null $lang = null, array|null $overwrites = [])
    {
        $this->lang = $lang ?? Lang::EN;
        $this->overwrites = $overwrites ?? [];
    }
}
