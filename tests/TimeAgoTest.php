<?php

declare(strict_types=1);

namespace Serhii\Tests;

use Carbon\CarbonImmutable;
use PHPUnit\Framework\TestCase;
use Serhii\Ago\Config;
use Serhii\Ago\TimeAgo;

class TimeAgoTest extends TestCase
{
    /**
     * @dataProvider providerForReturnsCorrectTime
     * @throws Exception
     */
    public function testReturnsCorrectTime(string $method, int $time, string $expect): void
    {
        TimeAgo::configure(new Config());

        $date = CarbonImmutable::now()->{$method}($time);
        $this->assertSame($expect, TimeAgo::trans($date));
    }

    public function providerForReturnsCorrectTime(): array
    {
        return [
            ['subMinutes', 1, '1 minute ago'],
            ['subMinutes', 2, '2 minutes ago'],
            ['subMinutes', 3, '3 minutes ago'],
            ['subMinutes', 4, '4 minutes ago'],
            ['subMinutes', 5, '5 minutes ago'],
            ['subMinutes', 11, '11 minutes ago'],
            ['subMinutes', 59, '59 minutes ago'],
            ['subMinutes', 60, '1 hour ago'],
            ['subHours', 1, '1 hour ago'],
            ['subHours', 4, '4 hours ago'],
            ['subHours', 13, '13 hours ago'],
            ['subHours', 24, '1 day ago'],
            ['subDays', 2, '2 days ago'],
            ['subDays', 7, '1 week ago'],
            ['subWeeks', 2, '2 weeks ago'],
            ['subMonths', 1, '1 month ago'],
            ['subMonths', 2, '2 months ago'],
            ['subMonths', 11, '11 months ago'],
            ['subMonths', 12, '1 year ago'],
            ['subYears', 5, '5 years ago'],
            ['subYears', 21, '21 years ago'],
            ['subYears', 31, '31 years ago'],
            ['subYears', 41, '41 years ago'],
            ['subYears', 100, '100 years ago'],
            ['subYears', 101, '101 years ago'],
        ];
    }
}
