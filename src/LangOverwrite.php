<?php

declare(strict_types=1);

namespace Serhii\Ago;

final readonly class LangOverwrite
{
    public function __construct(
        public Lang $lang,
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
