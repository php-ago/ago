<?php

declare(strict_types=1);

namespace Serhii\Ago;

final class LangSet
{
    public function __construct(
        public string $lang,
        public string $format,
        public string $ago,
        public string $online,
        public string $justNow,
        public LangForm $second,
        public LangForm $minute,
        public LangForm $hour,
        public LangForm $day,
        public LangForm $week,
        public LangForm $month,
        public LangForm $year,
    ) {
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
