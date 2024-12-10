<?php

declare(strict_types=1);

namespace Serhii\Tests\Translations;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Serhii\Ago\Config;
use Serhii\Ago\Lang as Lang;
use Serhii\Ago\TimeAgo;

final class DutchTest extends TestCase
{
    #[DataProvider('providerForReturnsCorrectTimeFromOneMinuteAndAbove')]
    public function testReturnsCorrectTimeFromOneMinuteAndAbove(string $input, string $expect): void
    {
        TimeAgo::reconfigure(new Config(lang: Lang::NL));
        $this->assertSame($expect, TimeAgo::trans($input));
    }

    public static function providerForReturnsCorrectTimeFromOneMinuteAndAbove(): array
    {
        return [
            ['now - 1 minutes', '1 minuut geleden'],
            ['now - 2 minutes', '2 minuten geleden'],
            ['now - 3 minutes', '3 minuten geleden'],
            ['now - 4 minutes', '4 minuten geleden'],
            ['now - 5 minutes', '5 minuten geleden'],
            ['now - 6 minutes', '6 minuten geleden'],
            ['now - 7 minutes', '7 minuten geleden'],
            ['now - 8 minutes', '8 minuten geleden'],
            ['now - 9 minutes', '9 minuten geleden'],
            ['now - 10 minutes', '10 minuten geleden'],
            ['now - 11 minutes', '11 minuten geleden'],
            ['now - 50 minutes', '50 minuten geleden'],
            ['now - 55 minutes', '55 minuten geleden'],
            ['now - 59 minutes', '59 minuten geleden'],
            ['now - 60 minutes', '1 uur geleden'],
            ['now - 1 hours', '1 uur geleden'],
            ['now - 2 hours', '2 uur geleden'],
            ['now - 3 hours', '3 uur geleden'],
            ['now - 4 hours', '4 uur geleden'],
            ['now - 13 hours', '13 uur geleden'],
            ['now - 24 hours', '1 dag geleden'],
            ['now - 2 days', '2 dagen geleden'],
            ['now - 3 days', '3 dagen geleden'],
            ['now - 7 days', '1 week geleden'],
            ['now - 2 weeks', '2 weken geleden'],
            ['now - 1 months', '1 maand geleden'],
            ['now - 2 months', '2 maanden geleden'],
            ['now - 11 months', '11 maanden geleden'],
            ['now - 12 months', '1 jaar geleden'],
            ['now - 5 years', '5 jaar geleden'],
            ['now - 21 years', '21 jaar geleden'],
            ['now - 31 years', '31 jaar geleden'],
            ['now - 41 years', '41 jaar geleden'],
            ['now - 100 years', '100 jaar geleden'],
            ['now - 101 years', '101 jaar geleden'],
        ];
    }

    #[DataProvider('providerForReturnsCorrectDateFrom0SecondsTo59Seconds')]
    public function testProviderForReturnsCorrectDateFrom0SecondsTo59Seconds(int $seconds, array $expect): void
    {
        TimeAgo::reconfigure(new Config(lang: Lang::NL));

        $result = TimeAgo::trans("now - {$seconds} seconds");
        $this->assertContains($result, $expect);
    }

    public static function providerForReturnsCorrectDateFrom0SecondsTo59Seconds(): array
    {
        return [
            [0, ['0 seconden geleden', '1 seconde geleden']],
            [1, ['1 seconde geleden', '2 seconden geleden']],
            [2, ['2 seconden geleden', '3 seconden geleden']],
            [5, ['5 seconden geleden', '6 seconden geleden']],
            [30, ['30 seconden geleden', '31 seconden geleden']],
            [42, ['42 seconden geleden', '43 seconden geleden']],
            [58, ['58 seconden geleden', '59 seconden geleden']],
        ];
    }
}
