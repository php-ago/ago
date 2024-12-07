<?php

declare(strict_types=1);

namespace Serhii\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Serhii\Ago\Config;
use Serhii\Ago\Lang;
use Serhii\Ago\Option;
use Serhii\Ago\TimeAgo;

final class TimeAgoTest extends TestCase
{
    #[DataProvider('providerForReturnsCorrectTime')]
    public function testReturnsCorrectTime(mixed $date, string $expect, array $options, Config $config): void
    {
        TimeAgo::configure($config);
        $this->assertSame($expect, TimeAgo::trans($date, ...$options));
    }

    public static function providerForReturnsCorrectTime(): array
    {
        return [
            [strtotime('now - 40 seconds'), 'Online', [Option::ONLINE], new Config(lang: Lang::EN)],
            [strtotime('now - 40 seconds'), 'Online', [Option::ONLINE], new Config(lang: Lang::EN)],
            [strtotime('now - 33 seconds'), 'Just now', [Option::JUST_NOW], new Config(lang: Lang::EN)],
            [strtotime('now - 40 seconds'), 'В сети', [Option::ONLINE], new Config(lang: Lang::RU)],
            [strtotime('now - 33 seconds'), 'Только что', [Option::JUST_NOW], new Config(lang: Lang::RU)],
            [strtotime('now - 1 minutes'), '1 minute ago', [], new Config(lang: Lang::EN)],
            [strtotime('now - 2 minutes'), '2 minutes ago', [], new Config(lang: Lang::EN)],
            [strtotime('now - 3 minutes'), '3 minutes', [Option::NO_SUFFIX], new Config(lang: Lang::EN)],
            [strtotime('now - 1 minutes'), '1 минута', [Option::NO_SUFFIX], new Config(lang: Lang::RU)],
            [strtotime('now - 4 minutes'), '4 minutes ago', [], new Config(lang: Lang::EN)],
            [strtotime('now - 5 minutes'), '5 minutes ago', [], new Config(lang: Lang::EN)],
            [strtotime('now - 11 minutes'), '11 minutes ago', [], new Config(lang: Lang::EN)],
            [strtotime('now - 59 minutes'), '59 minutes ago', [], new Config(lang: Lang::EN)],
            [strtotime('now - 3 minutes'), 'Vor 3 Minuten', [], new Config(lang: Lang::DE)],
            [strtotime('now - 1 hours'), '1 hour ago', [], new Config(lang: Lang::EN)],
            [strtotime('now - 4 hours'), '4 hours ago', [], new Config(lang: Lang::EN)],
            [strtotime('now - 13 hours'), '13 hours ago', [], new Config(lang: Lang::EN)],
            [strtotime('now - 24 hours'), '1 day ago', [], new Config(lang: Lang::EN)],
            [strtotime('now - 2 days'), '2 days ago', [], new Config(lang: Lang::EN)],
            [strtotime('now - 7 days'), '1 week ago', [], new Config(lang: Lang::EN)],
            [strtotime('now - 2 weeks'), '2 недели назад', [], new Config(lang: Lang::RU)],
            [strtotime('now - 1 months'), '1 month', [Option::NO_SUFFIX], new Config(lang: Lang::EN)],
            [strtotime('now - 2 months'), '2 months ago', [], new Config(lang: Lang::EN)],
            [strtotime('now - 11 months'), '11 months ago', [], new Config(lang: Lang::EN)],
            [strtotime('now - 12 months'), '1 year ago', [], new Config(lang: Lang::EN)],
            [strtotime('now - 5 years'), '5 years ago', [], new Config(lang: Lang::EN)],
            [strtotime('now - 21 years'), '21 years ago', [], new Config(lang: Lang::EN)],
            [strtotime('now - 31 years'), '31 years ago', [], new Config(lang: Lang::EN)],
            [strtotime('now - 41 years'), '41 years ago', [], new Config(lang: Lang::EN)],
            [strtotime('now - 100 years'), '100 years ago', [], new Config(lang: Lang::EN)],
            [strtotime('now - 101 years'), '101 years ago', [], new Config(lang: Lang::EN)],
            [strtotime('now - 121 year'), '121 jaar geleden', [], new Config(lang: Lang::NL)],
        ];
    }

    #[DataProvider('providerForDateEdges')]
    public function testDateEdges(string $input, string $expect): void
    {
        $fullMonths = ['1', '3', '5', '7', '8', '10', '12'];
        $currMonth = date('n');

        if (!in_array($currMonth, $fullMonths, strict: true)) {
            $this->markTestSkipped("Current month doesn't have 31 days. Test skipped");
        }

        $this->assertSame($expect, TimeAgo::trans(strtotime($input), Option::RESET_CONF));
    }

    public static function providerForDateEdges(): array
    {
        return [
            ['now - 31 days', '1 month ago'],
        ];
    }
}
