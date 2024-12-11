<?php

declare(strict_types=1);

namespace Serhii\Tests\Translations;

use PHPUnit\Framework\Attributes\DataProvider;
use Serhii\Ago\Lang;
use Serhii\Ago\TimeAgo;
use Serhii\Tests\TestCase;

final class RussianTest extends TestCase
{
    #[DataProvider('providerForReturnsCorrectTimeFromOneMinuteAndAbove')]
    public function testReturnsCorrectTimeFromOneMinuteAndAbove(string $input, string $expect): void
    {
        Lang::set(Lang::RU);
        $this->assertSame($expect, TimeAgo::trans($input));
    }

    public static function providerForReturnsCorrectTimeFromOneMinuteAndAbove(): array
    {
        return [
            ['-60 seconds', '1 минута назад'],
            ['-1 minute', '1 минута назад'],
            ['-2 minutes', '2 минуты назад'],
            ['-3 minutes', '3 минуты назад'],
            ['-4 minutes', '4 минуты назад'],
            ['-5 minutes', '5 минут назад'],
            ['-6 minutes', '6 минут назад'],
            ['-7 minutes', '7 минут назад'],
            ['-8 minutes', '8 минут назад'],
            ['-9 minutes', '9 минут назад'],
            ['-10 minutes', '10 минут назад'],
            ['-11 minutes', '11 минут назад'],
            ['-12 minutes', '12 минут назад'],
            ['-13 minutes', '13 минут назад'],
            ['-14 minutes', '14 минут назад'],
            ['-15 minutes', '15 минут назад'],
            ['-16 minutes', '16 минут назад'],
            ['-21 minutes', '21 минута назад'],
            ['-22 minutes', '22 минуты назад'],
            ['-23 minutes', '23 минуты назад'],
            ['-24 minutes', '24 минуты назад'],
            ['-25 minutes', '25 минут назад'],
            ['-59 minutes', '59 минут назад'],
            ['-59 minutes', '59 минут назад'],
            ['-60 minutes', '1 час назад'],
            ['-1 hour', '1 час назад'],
            ['-2 hours', '2 часа назад'],
            ['-3 hours', '3 часа назад'],
            ['-4 hours', '4 часа назад'],
            ['-5 hours', '5 часов назад'],
            ['-6 hours', '6 часов назад'],
            ['-7 hours', '7 часов назад'],
            ['-8 hours', '8 часов назад'],
            ['-9 hours', '9 часов назад'],
            ['-10 hours', '10 часов назад'],
            ['-11 hours', '11 часов назад'],
            ['-12 hours', '12 часов назад'],
            ['-13 hours', '13 часов назад'],
            ['-14 hours', '14 часов назад'],
            ['-15 hours', '15 часов назад'],
            ['-16 hours', '16 часов назад'],
            ['-17 hours', '17 часов назад'],
            ['-18 hours', '18 часов назад'],
            ['-19 hours', '19 часов назад'],
            ['-20 hours', '20 часов назад'],
            ['-21 hours', '21 час назад'],
            ['-22 hours', '22 часа назад'],
            ['-23 hours', '23 часа назад'],
            ['-24 hours', '1 день назад'],
            ['-2 days', '2 дня назад'],
            ['-7 days', '1 неделя назад'],
            ['-2 weeks', '2 недели назад'],
            ['-1 month', '1 месяц назад'],
            ['-2 months', '2 месяца назад'],
            ['-11 months', '11 месяцев назад'],
            ['-12 months', '1 год назад'],
            ['-2 years', '2 года назад'],
            ['-5 years', '5 лет назад'],
            ['-8 years', '8 лет назад'],
            ['-21 years', '21 год назад'],
            ['-22 years', '22 года назад'],
            ['-30 years', '30 лет назад'],
            ['-31 years', '31 год назад'],
            ['-41 years', '41 год назад'],
            ['-100 years', '100 лет назад'],
            ['-101 years', '101 год назад'],
        ];
    }

    #[DataProvider('providerForReturnsCorrectDateFrom0SecondsTo59Seconds')]
    public function testReturnsCorrectDateFrom0SecondsTo59Seconds(int $seconds, array $expect): void
    {
        Lang::set(Lang::RU);
        $result = TimeAgo::trans("-{$seconds} seconds");
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
