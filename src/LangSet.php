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

    public function __construct(array $translations)
    {
        $this->lang = $translations['lang'];
        $this->format = $translations['format'];
        $this->ago = $translations['ago'];
        $this->online = $translations['online'];
        $this->justNow = $translations['justnow'];
        $this->second = $translations['second'];
        $this->minute = $translations['minute'];
        $this->hour = $translations['hour'];
        $this->day = $translations['day'];
        $this->week = $translations['week'];
        $this->month = $translations['month'];
        $this->year = $translations['year'];
    }

    public function applyCustomTranslations(array $customTranslations): void
    {
        foreach ($customTranslations as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
