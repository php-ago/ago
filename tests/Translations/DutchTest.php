<?php

declare(strict_types=1);

namespace Serhii\Tests\Translations;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Serhii\Ago\Lang as Lang;
use Serhii\Ago\TimeAgo;

final class DutchTest extends TestCase
{
    public function tearDown(): void
    {
        TimeAgo::reconfigure();
        parent::tearDown();
    }

    #[DataProvider('providerForReturnsCorrectTimeFromOneMinuteAndAbove')]
    public function testReturnsCorrectTimeFromOneMinuteAndAbove(string $input, string $expect): void
    {
        Lang::set(Lang::NL);
        $this->assertSame($expect, TimeAgo::trans($input));
    }

    public static function providerForReturnsCorrectTimeFromOneMinuteAndAbove(): array
    {
        return [
            ['-1 minutes', '1 minuut geleden'],
            ['-2 minutes', '2 minuten geleden'],
            ['-3 minutes', '3 minuten geleden'],
            ['-4 minutes', '4 minuten geleden'],
            ['-5 minutes', '5 minuten geleden'],
            ['-6 minutes', '6 minuten geleden'],
            ['-7 minutes', '7 minuten geleden'],
            ['-8 minutes', '8 minuten geleden'],
            ['-9 minutes', '9 minuten geleden'],
            ['-10 minutes', '10 minuten geleden'],
            ['-11 minutes', '11 minuten geleden'],
            ['-50 minutes', '50 minuten geleden'],
            ['-55 minutes', '55 minuten geleden'],
            ['-59 minutes', '59 minuten geleden'],
            ['-60 minutes', '1 uur geleden'],
            ['-1 hours', '1 uur geleden'],
            ['-2 hours', '2 uur geleden'],
            ['-3 hours', '3 uur geleden'],
            ['-4 hours', '4 uur geleden'],
            ['-13 hours', '13 uur geleden'],
            ['-24 hours', '1 dag geleden'],
            ['-2 days', '2 dagen geleden'],
            ['-3 days', '3 dagen geleden'],
            ['-7 days', '1 week geleden'],
            ['-2 weeks', '2 weken geleden'],
            ['-1 months', '1 maand geleden'],
            ['-2 months', '2 maanden geleden'],
            ['-11 months', '11 maanden geleden'],
            ['-12 months', '1 jaar geleden'],
            ['-5 years', '5 jaar geleden'],
            ['-21 years', '21 jaar geleden'],
            ['-31 years', '31 jaar geleden'],
            ['-41 years', '41 jaar geleden'],
            ['-100 years', '100 jaar geleden'],
            ['-101 years', '101 jaar geleden'],
        ];
    }

    #[DataProvider('providerForReturnsCorrectDateFrom0SecondsTo59Seconds')]
    public function testProviderForReturnsCorrectDateFrom0SecondsTo59Seconds(int $seconds, array $expect): void
    {
        Lang::set(Lang::NL);
        $result = TimeAgo::trans("-{$seconds} seconds");
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
