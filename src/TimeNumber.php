<?php

declare(strict_types=1);

namespace Serhii\Ago;

final readonly class TimeNumber
{
    public function __construct(
        public int $seconds,
        public int $minutes,
        public int $hours,
        public int $days,
        public int $weeks,
        public int $months,
        public int $years,
    ) {
    }
}
