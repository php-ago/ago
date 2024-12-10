<?php

declare(strict_types=1);

namespace Serhii\Tests\Translations;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Serhii\Ago\Config;
use Serhii\Ago\Lang;
use Serhii\Ago\TimeAgo;

final class GermanTest extends TestCase
{
    #[DataProvider('providerForReturnsCorrectTimeFromOneMinuteAndAbove')]
    public function testReturnsCorrectTimeFromOneMinuteAndAbove(string $input, string $expect): void
    {
        TimeAgo::reconfigure(new Config(lang: Lang::DE));
        $this->assertSame($expect, TimeAgo::trans($input));
    }

    public static function providerForReturnsCorrectTimeFromOneMinuteAndAbove(): array
    {
        return [
            ['now - 60 seconds', 'Vor 1 Minute'],
            ['now - 1 minute', 'Vor 1 Minute'],
            ['now - 2 minutes', 'Vor 2 Minuten'],
            ['now - 3 minutes', 'Vor 3 Minuten'],
            ['now - 4 minutes', 'Vor 4 Minuten'],
            ['now - 5 minutes', 'Vor 5 Minuten'],
            ['now - 11 minutes', 'Vor 11 Minuten'],
            ['now - 59 minutes', 'Vor 59 Minuten'],
            ['now - 60 minutes', 'Vor 1 Stunde'],
            ['now - 1 hour', 'Vor 1 Stunde'],
            ['now - 4 hours', 'Vor 4 Stunden'],
            ['now - 13 hours', 'Vor 13 Stunden'],
            ['now - 24 hours', 'Vor 1 Tag'],
            ['now - 2 days', 'Vor 2 Tagen'],
            ['now - 7 days', 'Vor 1 Woche'],
            ['now - 2 weeks', 'Vor 2 Wochen'],
            ['now - 1 month', 'Vor 1 Monat'],
            ['now - 2 months', 'Vor 2 Monaten'],
            ['now - 11 months', 'Vor 11 Monaten'],
            ['now - 12 months', 'Vor 1 Jahr'],
            ['now - 5 years', 'Vor 5 Jahren'],
            ['now - 21 years', 'Vor 21 Jahren'],
            ['now - 31 years', 'Vor 31 Jahren'],
            ['now - 41 years', 'Vor 41 Jahren'],
            ['now - 100 years', 'Vor 100 Jahren'],
            ['now - 101 years', 'Vor 101 Jahren'],
        ];
    }

    #[DataProvider('providerForReturnsCorrectDateFrom0SecondsTo59Seconds')]
    public function testReturnsCorrectDateFrom0SecondsTo59Seconds(int $seconds, array $expect): void
    {
        TimeAgo::reconfigure(new Config(lang: Lang::DE));

        $result = TimeAgo::trans("now - {$seconds} seconds");
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
