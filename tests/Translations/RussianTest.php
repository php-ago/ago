<?php

declare(strict_types=1);

namespace Serhii\Tests\Translations;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Serhii\Ago\Config;
use Serhii\Ago\Lang;
use Serhii\Ago\TimeAgo;

final class RussianTest extends TestCase
{
    #[DataProvider('providerForReturnsCorrectTimeFromOneMinuteAndAbove')]
    public function testReturnsCorrectTimeFromOneMinuteAndAbove(string $input, string $expect): void
    {
        TimeAgo::configure(new Config(lang: Lang::RU));
        $this->assertSame($expect, TimeAgo::trans($input));
    }

    public static function providerForReturnsCorrectTimeFromOneMinuteAndAbove(): array
    {
        return [
            ['now - 60 seconds', '1 минута назад'],
            ['now - 1 minute', '1 минута назад'],
            ['now - 2 minutes', '2 минуты назад'],
            ['now - 3 minutes', '3 минуты назад'],
            ['now - 4 minutes', '4 минуты назад'],
            ['now - 5 minutes', '5 минут назад'],
            ['now - 6 minutes', '6 минут назад'],
            ['now - 7 minutes', '7 минут назад'],
            ['now - 8 minutes', '8 минут назад'],
            ['now - 9 minutes', '9 минут назад'],
            ['now - 10 minutes', '10 минут назад'],
            ['now - 11 minutes', '11 минут назад'],
            ['now - 12 minutes', '12 минут назад'],
            ['now - 13 minutes', '13 минут назад'],
            ['now - 14 minutes', '14 минут назад'],
            ['now - 15 minutes', '15 минут назад'],
            ['now - 16 minutes', '16 минут назад'],
            ['now - 21 minutes', '21 минута назад'],
            ['now - 22 minutes', '22 минуты назад'],
            ['now - 23 minutes', '23 минуты назад'],
            ['now - 24 minutes', '24 минуты назад'],
            ['now - 25 minutes', '25 минут назад'],
            ['now - 59 minutes', '59 минут назад'],
            ['now - 59 minutes', '59 минут назад'],
            ['now - 60 minutes', '1 час назад'],
            ['now - 1 hour', '1 час назад'],
            ['now - 2 hours', '2 часа назад'],
            ['now - 3 hours', '3 часа назад'],
            ['now - 4 hours', '4 часа назад'],
            ['now - 5 hours', '5 часов назад'],
            ['now - 6 hours', '6 часов назад'],
            ['now - 7 hours', '7 часов назад'],
            ['now - 8 hours', '8 часов назад'],
            ['now - 9 hours', '9 часов назад'],
            ['now - 10 hours', '10 часов назад'],
            ['now - 11 hours', '11 часов назад'],
            ['now - 12 hours', '12 часов назад'],
            ['now - 13 hours', '13 часов назад'],
            ['now - 14 hours', '14 часов назад'],
            ['now - 15 hours', '15 часов назад'],
            ['now - 16 hours', '16 часов назад'],
            ['now - 17 hours', '17 часов назад'],
            ['now - 18 hours', '18 часов назад'],
            ['now - 19 hours', '19 часов назад'],
            ['now - 20 hours', '20 часов назад'],
            ['now - 21 hours', '21 час назад'],
            ['now - 22 hours', '22 часа назад'],
            ['now - 23 hours', '23 часа назад'],
            ['now - 24 hours', '1 день назад'],
            ['now - 2 days', '2 дня назад'],
            ['now - 7 days', '1 неделя назад'],
            ['now - 2 weeks', '2 недели назад'],
            ['now - 1 month', '1 месяц назад'],
            ['now - 2 months', '2 месяца назад'],
            ['now - 11 months', '11 месяцев назад'],
            ['now - 12 months', '1 год назад'],
            ['now - 2 years', '2 года назад'],
            ['now - 5 years', '5 лет назад'],
            ['now - 8 years', '8 лет назад'],
            ['now - 21 years', '21 год назад'],
            ['now - 22 years', '22 года назад'],
            ['now - 30 years', '30 лет назад'],
            ['now - 31 years', '31 год назад'],
            ['now - 41 years', '41 год назад'],
            ['now - 100 years', '100 лет назад'],
            ['now - 101 years', '101 год назад'],
        ];
    }

    #[DataProvider('providerForReturnsCorrectDateFrom0SecondsTo59Seconds')]
    public function testReturnsCorrectDateFrom0SecondsTo59Seconds(int $seconds, array $expect): void
    {
        TimeAgo::configure(new Config(lang: Lang::RU));

        $result = TimeAgo::trans("now - {$seconds} seconds");
        $this->assertContains($result, $expect);
    }

    public static function providerForReturnsCorrectDateFrom0SecondsTo59Seconds(): array
    {
        return [
            [0, ['0 секунд назад', '1 секунда назад']],
            [1, ['1 секунда назад', '2 секунды назад']],
            [2, ['2 секунды назад', '3 секунды назад']],
            [5, ['5 секунд назад', '6 секунд назад']],
            [21, ['21 секунда назад', '22 секунды назад']],
            [58, ['58 секунд назад', '59 секунд назад']],
            [59, ['59 секунд назад', '1 минута назад']],
        ];
    }
}
