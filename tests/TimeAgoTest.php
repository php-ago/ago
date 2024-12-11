<?php

declare(strict_types=1);

namespace Serhii\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Serhii\Ago\Config;
use Serhii\Ago\Lang;
use Serhii\Ago\LangForm;
use Serhii\Ago\LangOverwrite;
use Serhii\Ago\Option;
use Serhii\Ago\TimeAgo;

final class TimeAgoTest extends TestCase
{
    public function tearDown(): void
    {
        TimeAgo::reconfigure();
        parent::tearDown();
    }

    #[DataProvider('providerForReturnsCorrectTime')]
    public function testReturnsCorrectTime(mixed $date, string $expect, array $options, string $lang): void
    {
        Lang::set($lang);
        $this->assertSame($expect, TimeAgo::trans($date, ...$options));
    }

    public static function providerForReturnsCorrectTime(): array
    {
        return [
            ['-40 seconds', 'Online', [Option::ONLINE], Lang::EN],
            ['-40 seconds', 'Online', [Option::ONLINE], Lang::EN],
            ['-33 seconds', 'Just now', [Option::JUST_NOW], Lang::EN],
            ['-40 seconds', 'В сети', [Option::ONLINE], Lang::RU],
            ['-33 seconds', 'Только что', [Option::JUST_NOW], Lang::RU],
            ['-1 minutes', '1 minute ago', [], Lang::EN],
            ['-2 minutes', '2 minutes ago', [], Lang::EN],
            ['-3 minutes', '3 minutes', [Option::NO_SUFFIX], Lang::EN],
            ['-1 minutes', '1 минута', [Option::NO_SUFFIX], Lang::RU],
            ['-4 minutes', '4 minutes ago', [], Lang::EN],
            ['-5 minutes', '5 minutes ago', [], Lang::EN],
            ['11 minutes', '11 minutes', [], Lang::EN],
            ['-59 minutes', '59 minutes ago', [], Lang::EN],
            ['-3 minutes', 'Vor 3 Minuten', [], Lang::DE],
            ['-1 hours', '1 hour ago', [], Lang::EN],
            ['-4 hours', '4 hours ago', [], Lang::EN],
            ['-13 hours', '13 hours ago', [], Lang::EN],
            ['-24 hours', '1 day ago', [], Lang::EN],
            ['-2 days', '2 days ago', [], Lang::EN],
            ['-7 days', '1 week ago', [], Lang::EN],
            ['-2 weeks', '2 недели назад', [], Lang::RU],
            ['-1 months', '1 month', [Option::NO_SUFFIX], Lang::EN],
            ['-2 months', '2 months ago', [], Lang::EN],
            ['-11 months', '11 months ago', [], Lang::EN],
            ['-12 months', '1 year ago', [], Lang::EN],
            ['-5 years', '5 years ago', [], Lang::EN],
            ['-21 years', '21 years ago', [], Lang::EN],
            ['-31 years', '31 years ago', [], Lang::EN],
            ['-41 years', '41 years ago', [], Lang::EN],
            ['-100 years', '100 years ago', [], Lang::EN],
            ['-101 years', '101 years ago', [], Lang::EN],
            ['-121 year', '121 jaar geleden', [], Lang::NL],
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

        $this->assertSame($expect, TimeAgo::trans($input, Option::RESET_CONF));
    }

    public static function providerForDateEdges(): array
    {
        return [
            ['-31 days', '1 month ago'],
            ['yesterday', '1 day ago'],
        ];
    }

    #[DataProvider('providerForOverrides')]
    public function testOverwrites(string $input, string $expect, string $lang, array $overwrites): void
    {
        TimeAgo::reconfigure(new Config(lang: $lang, overwrites: $overwrites));
        $this->assertSame($expect, TimeAgo::trans($input));
    }

    public static function providerForOverrides(): array
    {
        return [
            [
                '-2 days',
                '2d',
                Lang::EN,
                [
                    new LangOverwrite(
                        lang: Lang::EN,
                        format: '{num}{timeUnit}',
                        day: new LangForm(other: 'd', one: 'd'),
                    ),
                ],
            ],
            [
                '-4 months',
                '4 мес. назад',
                Lang::RU,
                [
                    new LangOverwrite(
                        lang: Lang::RU,
                        month: new LangForm(other: 'мес.', one: 'мес.', few: 'мес.'),
                    ),
                ],
            ],
            [
                '-2 days',
                '2 - д',
                Lang::RU,
                [
                    new LangOverwrite(lang: Lang::RU, format: '{num} - {timeUnit}'),
                    new LangOverwrite(lang: Lang::RU, day: new LangForm(other: 'д', one: 'д')),
                ],
            ],
            [
                '-4 days',
                '4 days ago',
                Lang::EN,
                [
                    new LangOverwrite(lang: Lang::RU, format: '{num} - {timeUnit}'),
                    new LangOverwrite(lang: Lang::RU, day: new LangForm(other: 'д', one: 'д')),
                ],
            ],
        ];
    }

    public function testConfigureMethodChangesOnlySpecificFields(): void
    {
        TimeAgo::reconfigure(new Config(
            lang: Lang::RU,
            overwrites: [
                new LangOverwrite(
                    lang: Lang::RU,
                    format: '{num}{timeUnit}',
                    minute: new LangForm(other: 'м', one: 'м'),
                ),
            ],
        ));

        $this->assertSame('1м', TimeAgo::trans('-1 minute'));

        TimeAgo::configure(new Config(lang: Lang::EN));

        $this->assertSame('1 minute ago', TimeAgo::trans('-1 minute'));
    }

    public function testLanguageSwitchWithLangClass(): void
    {
        Lang::set(Lang::RU);
        $this->assertSame('2 минуты', TimeAgo::trans('2 minutes'));

        Lang::set(Lang::UK);
        $this->assertSame('3 хвилини', TimeAgo::trans('3 minutes'));

        Lang::set(Lang::EN);
        $this->assertSame('5 minutes ago', TimeAgo::trans('-5 minutes'));
    }
}
