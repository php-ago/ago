<?php

declare(strict_types=1);

namespace Serhii\Ago;

class Config
{
    public Lang $lang = Lang::EN;
    public LangSet|null $customTranslations = null;

    /**
     * @param Lang|null $lang Language code following ISO 639-1
     * standard. Default is English.
     *
     * @param LangSet|null $customTranslations Custom translations
     * will override default translations with the same keys. Use
     * it to add or change translations. Default is null.
     */
    public function __construct(Lang|null $lang = null, LangSet|null $customTranslations = null)
    {
        $this->lang = $lang ?? Lang::EN;
        $this->customTranslations = $customTranslations;
    }
}
