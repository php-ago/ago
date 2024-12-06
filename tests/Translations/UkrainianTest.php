<?php

declare(strict_types=1);

namespace Serhii\Tests\Translations;

use Carbon\CarbonImmutable;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Serhii\Ago\Config;
use Serhii\Ago\Lang;
use Serhii\Ago\TimeAgo;

final class UkrainianTest extends TestCase
{
    #[DataProvider('providerForReturnsCorrectTimeFromOneMinuteAndAbove')]
    public function testReturnsCorrectTimeFromOneMinuteAndAbove(string $method, int $time, string $output): void
    {
        TimeAgo::configure(new Config(lang: Lang::UK));

        $date = CarbonImmutable::now()->{$method}($time)->toDateTimeString();
        $this->assertSame($output, TimeAgo::trans($date));
    }

    public static function providerForReturnsCorrectTimeFromOneMinuteAndAbove(): array
    {
        return [
            ['subSeconds', 60, '1 хвилина тому'],
            ['subMinutes', 1, '1 хвилина тому'],
            ['subMinutes', 2, '2 хвилини тому'],
            ['subMinutes', 3, '3 хвилини тому'],
            ['subMinutes', 4, '4 хвилини тому'],
            ['subMinutes', 5, '5 хвилин тому'],
            ['subMinutes', 6, '6 хвилин тому'],
            ['subMinutes', 7, '7 хвилин тому'],
            ['subMinutes', 8, '8 хвилин тому'],
            ['subMinutes', 9, '9 хвилин тому'],
            ['subMinutes', 10, '10 хвилин тому'],
            ['subMinutes', 11, '11 хвилин тому'],
            ['subMinutes', 12, '12 хвилин тому'],
            ['subMinutes', 13, '13 хвилин тому'],
            ['subMinutes', 59, '59 хвилин тому'],
            ['subMinutes', 60, '1 година тому'],
            ['subHours', 1, '1 година тому'],
            ['subHours', 2, '2 години тому'],
            ['subHours', 3, '3 години тому'],
            ['subHours', 4, '4 години тому'],
            ['subHours', 5, '5 годин тому'],
            ['subHours', 6, '6 годин тому'],
            ['subHours', 7, '7 годин тому'],
            ['subHours', 8, '8 годин тому'],
            ['subHours', 9, '9 годин тому'],
            ['subHours', 10, '10 годин тому'],
            ['subHours', 11, '11 годин тому'],
            ['subHours', 12, '12 годин тому'],
            ['subHours', 13, '13 годин тому'],
            ['subHours', 14, '14 годин тому'],
            ['subHours', 15, '15 годин тому'],
            ['subHours', 16, '16 годин тому'],
            ['subHours', 17, '17 годин тому'],
            ['subHours', 18, '18 годин тому'],
            ['subHours', 19, '19 годин тому'],
            ['subHours', 20, '20 годин тому'],
            ['subHours', 21, '21 година тому'],
            ['subHours', 22, '22 години тому'],
            ['subHours', 23, '23 години тому'],
            ['subHours', 24, '1 день тому'],
            ['subDays', 5, '5 днів тому'],
            ['subDays', 2, '2 дні тому'],
            ['subDays', 7, '1 тиждень тому'],
            ['subWeeks', 2, '2 тижні тому'],
            ['subMonths', 1, '1 місяць тому'],
            ['subMonths', 2, '2 місяці тому'],
            ['subMonths', 11, '11 місяців тому'],
            ['subMonths', 12, '1 рік тому'],
            ['subYears', 5, '5 років тому'],
            ['subYears', 21, '21 рік тому'],
            ['subYears', 30, '30 років тому'],
            ['subYears', 31, '31 рік тому'],
            ['subYears', 41, '41 рік тому'],
            ['subYears', 100, '100 років тому'],
            ['subYears', 101, '101 рік тому'],
        ];
    }


    #[DataProvider('providerForReturnsCorrectDateFrom0SecondsTo59Seconds')]
    public function testReturnsCorrectDateFrom0SecondsTo59Seconds(int $seconds, array $expect): void
    {
        TimeAgo::configure(new Config(lang: Lang::UK));

        $date = CarbonImmutable::now()->subSeconds($seconds)->toDateTimeString();
        $msg = sprintf("Expected '%s' or '%s' but got '%s'", $expect[0], $expect[1], $result = TimeAgo::trans($date));
        $this->assertContains($result, $expect, $msg);
    }

    public static function providerForReturnsCorrectDateFrom0SecondsTo59Seconds(): array
    {
        return [
            [0, ['0 секунд тому', '1 секунда тому']],
            [1, ['1 секунда тому', '2 секунди тому']],
            [2, ['2 секунди тому', '3 секунди тому']],
            [3, ['3 секунди тому', '4 секунди тому']],
            [4, ['4 секунди тому', '5 секунд тому']],
            [5, ['5 секунд тому', '6 секунд тому']],
            [6, ['6 секунд тому', '7 секунд тому']],
            [7, ['7 секунд тому', '8 секунд тому']],
            [8, ['8 секунд тому', '9 секунд тому']],
            [9, ['9 секунд тому', '10 секунд тому']],
            [10, ['10 секунд тому', '11 секунд тому']],
            [11, ['11 секунд тому', '12 секунд тому']],
            [12, ['12 секунд тому', '13 секунд тому']],
            [13, ['13 секунд тому', '14 секунд тому']],
            [14, ['14 секунд тому', '15 секунд тому']],
            [15, ['15 секунд тому', '16 секунд тому']],
            [16, ['16 секунд тому', '17 секунд тому']],
            [17, ['17 секунд тому', '18 секунд тому']],
            [18, ['18 секунд тому', '19 секунд тому']],
            [19, ['19 секунд тому', '20 секунд тому']],
            [20, ['20 секунд тому', '21 секунда тому']],
            [21, ['21 секунда тому', '22 секунди тому']],
            [41, ['41 секунда тому', '42 секунди тому']],
            [54, ['54 секунди тому', '55 секунд тому']],
            [58, ['58 секунд тому', '59 секунд тому']],
        ];
    }
}
