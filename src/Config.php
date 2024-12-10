<?php

declare(strict_types=1);

namespace Serhii\Ago;

class Config
{
    public string $lang = Lang::EN;

    /**
     * @var array<int,LangOverwrite>
     */
    public array $overwrites = [];

    /**
     * @param string|null $lang Language code ISO 639-1.
     * Default is English (en).
     *
     * @param array<int,LangOverwrite>|null $overwrites Overwrite default
     * translations.
     */
    public function __construct(string|null $lang = null, array|null $overwrites = [])
    {
        $this->lang = $lang ?? Lang::EN;
        $this->overwrites = $overwrites ?? [];
    }
}
