<?php

declare(strict_types=1);

namespace Serhii\Ago;

final class LangSet
{
    public string $lang;
    public string $format;
    public string $ago;
    public string $online;
    public string $justNow;

    /** @var array<string,string> */
    public array $second;

    /** @var array<string,string> */
    public array $minute;

    /** @var array<string,string> */
    public array $hour;

    /** @var array<string,string> */
    public array $day;

    /** @var array<string,string> */
    public array $week;

    /** @var array<string,string> */
    public array $month;

    /** @var array<string,string> */
    public array $year;

    public function __construct(private Config $config)
    {
        $this->loadTranslations();
    }

    public function loadTranslations(): void
    {
        $path = __DIR__ . "/../locales/{$this->config->lang->value}.php";
        $translations = require $path;

        dd($translations);
    }
}
