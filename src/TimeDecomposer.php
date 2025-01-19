<?php

declare(strict_types=1);

namespace Serhii\Ago;

use RuntimeException;

final class TimeDecomposer
{
    private const MINUTE = 60;
    private const HOUR = self::MINUTE * 60;
    private const DAY = self::HOUR * 24;
    private const WEEK = self::DAY * 7;
    private const MONTH_31 = self::DAY * 31;
    private const MONTH_30 = self::DAY * 30;
    private const MONTH_29 = self::DAY * 29;
    private const MONTH_28 = self::DAY * 28;
    private const YEAR_366 = self::DAY * 366;
    private const YEAR_365 = self::DAY * 365;

    /**
     * @throws RuntimeException
     */
    public function calculateTimeNum(int $timeInSec): TimeNumber
    {
        return new TimeNumber(
            seconds: $timeInSec,
            minutes: (int) floor($timeInSec / self::MINUTE),
            hours: (int) floor($timeInSec / self::HOUR),
            days: (int) floor($timeInSec / self::DAY),
            weeks: (int) floor($timeInSec / self::WEEK),
            months: $this->calculateTimeNumForMonth($timeInSec),
            years: $this->calculateTimeNumForYear($timeInSec),
        );
    }

    private function lastDayOfMonth(): int
    {
        return (int) date('d', strtotime('last day of this month'));
    }

    private function lastDayOfYear(): int
    {
        return 1 + ((int) date('z', strtotime('December 31')));
    }

    /**
     * @throws RuntimeException
     */
    private function calculateTimeNumForMonth(int $timeInSec): int
    {
        return match ($this->lastDayOfMonth()) {
            31 => (int) round($timeInSec / self::MONTH_31),
            30 => (int) round($timeInSec / self::MONTH_30),
            29 => (int) round($timeInSec / self::MONTH_29),
            28 => (int) round($timeInSec / self::MONTH_28),
            default => throw new RuntimeException('[Ago]: Invalid number of days in month'),
        };
    }

    /**
     * @throws RuntimeException
     */
    private function calculateTimeNumForYear(int $timeInSec): int
    {
        return match ($this->lastDayOfYear()) {
            366 => (int) round($timeInSec / self::YEAR_366),
            365 => (int) round($timeInSec / self::YEAR_365),
            default => throw new RuntimeException('[Ago]: Invalid number of days in year'),
        };
    }
}
