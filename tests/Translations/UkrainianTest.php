<?php

declare(strict_types=1);

namespace Serhii\Tests\Translations;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Serhii\Ago\Config;
use Serhii\Ago\Lang;
use Serhii\Ago\TimeAgo;

final class UkrainianTest extends TestCase
{
    #[DataProvider('providerForReturnsCorrectTimeFromOneMinuteAndAbove')]
    public function testReturnsCorrectTimeFromOneMinuteAndAbove(string $input, string $output): void
    {
        TimeAgo::configure(new Config(lang: Lang::UK));
        $this->assertSame($output, TimeAgo::trans($input));
    }

    public static function providerForReturnsCorrectTimeFromOneMinuteAndAbove(): array
    {
        return [
            ['now - 60 seconds', '1 хвилина тому'],
            ['now - 1 minutes', '1 хвилина тому'],
            ['now - 2 minutes', '2 хвилини тому'],
            ['now - 3 minutes', '3 хвилини тому'],
            ['now - 4 minutes', '4 хвилини тому'],
            ['now - 5 minutes', '5 хвилин тому'],
            ['now - 6 minutes', '6 хвилин тому'],
            ['now - 7 minutes', '7 хвилин тому'],
            ['now - 8 minutes', '8 хвилин тому'],
            ['now - 9 minutes', '9 хвилин тому'],
            ['now - 10 minutes', '10 хвилин тому'],
            ['now - 11 minutes', '11 хвилин тому'],
            ['now - 12 minutes', '12 хвилин тому'],
            ['now - 13 minutes', '13 хвилин тому'],
            ['now - 59 minutes', '59 хвилин тому'],
            ['now - 60 minutes', '1 година тому'],
            ['now - 1 hours', '1 година тому'],
            ['now - 2 hours', '2 години тому'],
            ['now - 3 hours', '3 години тому'],
            ['now - 4 hours', '4 години тому'],
            ['now - 5 hours', '5 годин тому'],
            ['now - 6 hours', '6 годин тому'],
            ['now - 7 hours', '7 годин тому'],
            ['now - 8 hours', '8 годин тому'],
            ['now - 9 hours', '9 годин тому'],
            ['now - 10 hours', '10 годин тому'],
            ['now - 11 hours', '11 годин тому'],
            ['now - 12 hours', '12 годин тому'],
            ['now - 13 hours', '13 годин тому'],
            ['now - 14 hours', '14 годин тому'],
            ['now - 15 hours', '15 годин тому'],
            ['now - 16 hours', '16 годин тому'],
            ['now - 17 hours', '17 годин тому'],
            ['now - 18 hours', '18 годин тому'],
            ['now - 19 hours', '19 годин тому'],
            ['now - 20 hours', '20 годин тому'],
            ['now - 21 hours', '21 година тому'],
            ['now - 22 hours', '22 години тому'],
            ['now - 23 hours', '23 години тому'],
            ['now - 24 hours', '1 день тому'],
            ['now - 5 days', '5 днів тому'],
            ['now - 2 days', '2 дні тому'],
            ['now - 7 days', '1 тиждень тому'],
            ['now - 2 weeks', '2 тижні тому'],
            ['now - 1 months', '1 місяць тому'],
            ['now - 2 months', '2 місяці тому'],
            ['now - 11 months', '11 місяців тому'],
            ['now - 12 months', '1 рік тому'],
            ['now - 5 years', '5 років тому'],
            ['now - 21 years', '21 рік тому'],
            ['now - 30 years', '30 років тому'],
            ['now - 31 years', '31 рік тому'],
            ['now - 41 years', '41 рік тому'],
            ['now - 100 years', '100 років тому'],
            ['now - 101 years', '101 рік тому'],
        ];
    }


    #[DataProvider('providerForReturnsCorrectDateFrom0SecondsTo59Seconds')]
    public function testReturnsCorrectDateFrom0SecondsTo59Seconds(int $seconds, array $expect): void
    {
        TimeAgo::configure(new Config(lang: Lang::UK));

        $result = TimeAgo::trans("now - {$seconds} seconds");
        $this->assertContains($result, $expect);
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
