<?php

declare(strict_types=1);

namespace Serhii\Ago;

class Config
{
    public Lang $lang = Lang::EN;

    /**
     * @var array<int,LangSet>
     */
    public array $overrides = [];

    /**
     * @param Lang|null $lang Language code from the Lang enum
     * Default is English.
     *
     * @param array<int,LangSet> $overrides Overrides will
     * override default translations with the same keys. Use
     * it to add or change translations.
     */
    public function __construct(Lang|null $lang = null, array|null $overrides = [])
    {
        $this->lang = $lang ?? Lang::EN;
        $this->overrides = $overrides ?? [];
    }
}
