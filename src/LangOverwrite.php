<?php

declare(strict_types=1);

namespace Serhii\Ago;

final readonly class LangOverwrite
{
    /**
     * @param string $lang Language code ISO 639-1
     * @param string|null $format Format of the final output
     * @param string|null $ago Suffix for the final output like "ago"
     * @param string|null $online Is shown when the date is withing a small threshold
     * @param string|null $justNow Is shown when the date is within a small threshold
     * with Option::JUST_NOW enabled
     */
    public function __construct(
        public string $lang,
        public string|null $format = null,
        public string|null $ago = null,
        public string|null $online = null,
        public string|null $justNow = null,
        public LangForm|null $second = null,
        public LangForm|null $minute = null,
        public LangForm|null $hour = null,
        public LangForm|null $day = null,
        public LangForm|null $week = null,
        public LangForm|null $month = null,
        public LangForm|null $year = null,
    ) {
    }
}
