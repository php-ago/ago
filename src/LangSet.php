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

    public LangForm $second;
    public LangForm $minute;
    public LangForm $hour;
    public LangForm $day;
    public LangForm $week;
    public LangForm $month;
    public LangForm $year;

    /**
     * @param array<string,mixed> $translations
     */
    public function __construct(array $translations)
    {
        $this->lang = $translations['lang'];
        $this->format = $translations['format'];
        $this->ago = $translations['ago'];
        $this->online = $translations['online'];
        $this->justNow = $translations['justnow'];

        $this->second = new LangForm(...$translations['second']);
        $this->minute = new LangForm(...$translations['minute']);
        $this->hour = new LangForm(...$translations['hour']);
        $this->day = new LangForm(...$translations['day']);
        $this->week = new LangForm(...$translations['week']);
        $this->month = new LangForm(...$translations['month']);
        $this->year = new LangForm(...$translations['year']);
    }

    public function applyOverwrites(Config $config): void
    {
        foreach ($config->overwrites as $langSet) {
            if ($langSet->lang !== $config->lang) {
                continue;
            }

            $this->applyLangSet($langSet);
        }
    }

    private function applyLangSet(LangOverwrite $overwrites): void
    {
        foreach (get_object_vars($overwrites) as $prop => $value) {
            if ($value && property_exists($this, $prop)) {
                if ($value instanceof Lang) {
                    $this->lang = $value->value;
                    continue;
                }

                $this->$prop = $value;
            }
        }
    }
}
