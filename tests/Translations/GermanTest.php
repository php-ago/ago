<?php

declare(strict_types=1);

namespace Serhii\Tests\Translations;

use PHPUnit\Framework\Attributes\DataProvider;
use Serhii\Ago\Lang;
use Serhii\Ago\TimeAgo;
use Serhii\Tests\TestCase;

final class GermanTest extends TestCase
{
    #[DataProvider('providerForReturnsCorrectTimeFromOneMinuteAndAbove')]
    public function testReturnsCorrectTimeFromOneMinuteAndAbove(string $input, string $expect): void
    {
        Lang::set(Lang::DE);
        $this->assertSame($expect, TimeAgo::trans($input));
    }

    public static function providerForReturnsCorrectTimeFromOneMinuteAndAbove(): array
    {
        return [
            ['-60 seconds', 'Vor 1 Minute'],
            ['-1 minute', 'Vor 1 Minute'],
            ['-2 minutes', 'Vor 2 Minuten'],
            ['-3 minutes', 'Vor 3 Minuten'],
            ['-4 minutes', 'Vor 4 Minuten'],
            ['-5 minutes', 'Vor 5 Minuten'],
            ['-11 minutes', 'Vor 11 Minuten'],
            ['-59 minutes', 'Vor 59 Minuten'],
            ['-60 minutes', 'Vor 1 Stunde'],
            ['-1 hour', 'Vor 1 Stunde'],
            ['-4 hours', 'Vor 4 Stunden'],
            ['-13 hours', 'Vor 13 Stunden'],
            ['-24 hours', 'Vor 1 Tag'],
            ['-2 days', 'Vor 2 Tagen'],
            ['-7 days', 'Vor 1 Woche'],
            ['-2 weeks', 'Vor 2 Wochen'],
            ['-1 month', 'Vor 1 Monat'],
            ['-2 months', 'Vor 2 Monaten'],
            ['-11 months', 'Vor 11 Monaten'],
            ['-12 months', 'Vor 1 Jahr'],
            ['-5 years', 'Vor 5 Jahren'],
            ['-21 years', 'Vor 21 Jahren'],
            ['-31 years', 'Vor 31 Jahren'],
            ['-41 years', 'Vor 41 Jahren'],
            ['-100 years', 'Vor 100 Jahren'],
            ['-101 years', 'Vor 101 Jahren'],
        ];
    }

    #[DataProvider('providerForReturnsCorrectDateFrom0SecondsTo59Seconds')]
    public function testReturnsCorrectDateFrom0SecondsTo59Seconds(int $seconds, array $expect): void
    {
        Lang::set(Lang::DE);
        $result = TimeAgo::trans("-{$seconds} seconds");
        $this->assertContains($result, $expect);
    }

    public static function providerForReturnsCorrectDateFrom0SecondsTo59Seconds(): array
    {
        return [
            [0, ['Vor 0 Sekunden', 'Vor 1 Sekunde']],
            [1, ['Vor 1 Sekunde', 'Vor 2 Sekunden']],
            [2, ['Vor 2 Sekunden', 'Vor 3 Sekunden']],
            [30, ['Vor 30 Sekunden', 'Vor 31 Sekunden']],
            [58, ['Vor 58 Sekunden', 'Vor 59 Sekunden']],
        ];
    }
}
