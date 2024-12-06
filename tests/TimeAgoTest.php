<?php

declare(strict_types=1);

namespace Serhii\Tests;

use Carbon\CarbonImmutable;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Serhii\Ago\Config;
use Serhii\Ago\Lang;
use Serhii\Ago\Option;
use Serhii\Ago\TimeAgo;

final class TimeAgoTest extends TestCase
{
    #[DataProvider('providerForReturnsCorrectTime')]
    public function testReturnsCorrectTime(
        string $method,
        int $time,
        string $expect,
        array $options,
        Lang $lang,
    ): void {
        TimeAgo::configure(new Config(lang: $lang));

        $date = CarbonImmutable::now()->{$method}($time);
        $this->assertSame($expect, TimeAgo::trans($date, ...$options));
    }

    public static function providerForReturnsCorrectTime(): array
    {
        return [
            ['subSeconds', 40, 'Online', [Option::ONLINE], Lang::EN],
            ['subSeconds', 33, 'Just now', [Option::JUST_NOW], Lang::EN],
            ['subSeconds', 40, 'В сети', [Option::ONLINE], Lang::RU],
            ['subSeconds', 33, 'Только что', [Option::JUST_NOW], Lang::RU],
            ['subMinutes', 1, '1 minute ago', [], Lang::EN],
            ['subMinutes', 2, '2 minutes ago', [], Lang::EN],
            ['subMinutes', 3, '3 minutes', [Option::NO_SUFFIX], Lang::EN],
            ['subMinutes', 1, '1 минута', [Option::NO_SUFFIX], Lang::RU],
            ['subMinutes', 4, '4 minutes ago', [], Lang::EN],
            ['subMinutes', 5, '5 minutes ago', [], Lang::EN],
            ['subMinutes', 11, '11 minutes ago', [], Lang::EN],
            ['subMinutes', 59, '59 minutes ago', [], Lang::EN],
            ['subMinutes', 3, 'Vor 3 Minuten', [], Lang::DE],
            ['subHours', 1, '1 hour ago', [], Lang::EN],
            ['subHours', 4, '4 hours ago', [], Lang::EN],
            ['subHours', 13, '13 hours ago', [], Lang::EN],
            ['subHours', 24, '1 day ago', [], Lang::EN],
            ['subDays', 2, '2 days ago', [], Lang::EN],
            ['subDays', 7, '1 week ago', [], Lang::EN],
            ['subWeeks', 2, '2 недели назад', [], Lang::RU],
            ['subMonths', 1, '1 month', [Option::NO_SUFFIX], Lang::EN],
            ['subMonths', 2, '2 months ago', [], Lang::EN],
            ['subMonths', 11, '11 months ago', [], Lang::EN],
            ['subMonths', 12, '1 year ago', [], Lang::EN],
            ['subYears', 5, '5 years ago', [], Lang::EN],
            ['subYears', 21, '21 years ago', [], Lang::EN],
            ['subYears', 31, '31 years ago', [], Lang::EN],
            ['subYears', 41, '41 years ago', [], Lang::EN],
            ['subYears', 100, '100 years ago', [], Lang::EN],
            ['subYears', 101, '101 years ago', [], Lang::EN],
            ['subYears', 121, '121 jaar geleden', [], Lang::NL],
        ];
    }
}
