<?php

declare(strict_types=1);

namespace Serhii\Ago;

class Config
{
    public string $lang = Lang::EN;

    /**
     * @var array<int,LangOverride>
     */
    public array $overrides = [];

    /**
     * @param string|null $lang Language code ISO 639-1.
     * Default is English (en).
     *
     * @param array<int,LangOverride>|null $overrides Overrides will override
     * default translations.
     */
    public function __construct(string|null $lang = null, array|null $overrides = [])
    {
        $this->lang = $lang ?? Lang::EN;
        $this->overrides = $overrides ?? [];
    }
}
