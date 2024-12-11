<?php

declare(strict_types=1);

namespace Serhii\Ago;

final class LangOverwrite
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
        public readonly string $lang,
        public readonly string|null $format = null,
        public readonly string|null $ago = null,
        public readonly string|null $online = null,
        public readonly string|null $justNow = null,
        public readonly LangForm|null $second = null,
        public readonly LangForm|null $minute = null,
        public readonly LangForm|null $hour = null,
        public readonly LangForm|null $day = null,
        public readonly LangForm|null $week = null,
        public readonly LangForm|null $month = null,
        public readonly LangForm|null $year = null,
    ) {
    }
}
