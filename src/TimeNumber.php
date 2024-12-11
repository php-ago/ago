<?php

declare(strict_types=1);

namespace Serhii\Ago;

final class TimeNumber
{
    public function __construct(
        public readonly int $seconds,
        public readonly int $minutes,
        public readonly int $hours,
        public readonly int $days,
        public readonly int $weeks,
        public readonly int $months,
        public readonly int $years,
    ) {
    }
}
