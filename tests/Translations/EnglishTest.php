<?php

declare(strict_types=1);

namespace Serhii\Tests\Translations;

use PHPUnit\Framework\Attributes\DataProvider;
use Serhii\Ago\Lang;
use Serhii\Ago\TimeAgo;
use Serhii\Tests\TestCase;

final class EnglishTest extends TestCase
{
    #[DataProvider('providerForReturnsCorrectTimeFromOneMinuteAndAbove')]
    public function testReturnsCorrectTimeFromOneMinuteAndAbove(string $input, string $expect): void
    {
        Lang::set(Lang::EN);
        $this->assertSame($expect, TimeAgo::trans($input));
    }

    public static function providerForReturnsCorrectTimeFromOneMinuteAndAbove(): array
    {
        return [
            ['1 minute', '1 minute'],
            ['3 minutes', '3 minutes'],
            ['1 hour', '1 hour'],
            ['4 hours', '4 hours'],
            ['1 day', '1 day'],
            ['6 days', '6 days'],
            ['1 week', '1 week'],
            ['2 weeks', '2 weeks'],
            ['1 month', '1 month'],
            ['8 months', '8 months'],
            ['1 year', '1 year'],
            ['10 years', '10 years'],
            ['-60 seconds', '1 minute ago'],
            ['-1 minute', '1 minute ago'],
            ['-2 minutes', '2 minutes ago'],
            ['-3 minutes', '3 minutes ago'],
            ['-4 minutes', '4 minutes ago'],
            ['-5 minutes', '5 minutes ago'],
            ['-11 minutes', '11 minutes ago'],
            ['-59 minutes', '59 minutes ago'],
            ['-60 minutes', '1 hour ago'],
            ['-1 hour', '1 hour ago'],
            ['-4 hours', '4 hours ago'],
            ['-13 hours', '13 hours ago'],
            ['-24 hours', '1 day ago'],
            ['-2 days', '2 days ago'],
            ['-7 days', '1 week ago'],
            ['-2 weeks', '2 weeks ago'],
            ['-1 month', '1 month ago'],
            ['-2 months', '2 months ago'],
            ['-11 months', '11 months ago'],
            ['-12 months', '1 year ago'],
            ['-5 years', '5 years ago'],
            ['-7 years', '7 years ago'],
            ['-21 years', '21 years ago'],
            ['-31 years', '31 years ago'],
            ['-41 years', '41 years ago'],
            ['-100 years', '100 years ago'],
            ['-101 years', '101 years ago'],
        ];
    }

    #[DataProvider('providerForReturnsCorrectDateFrom0SecondsTo59Seconds')]
    public function testProviderForReturnsCorrectDateFrom0SecondsTo59Seconds(int $seconds, array $expect): void
    {
        Lang::set(Lang::EN);

        $result = TimeAgo::trans("-{$seconds} seconds");
        $this->assertContains($result, $expect);
    }

    public static function providerForReturnsCorrectDateFrom0SecondsTo59Seconds(): array
    {
        return [
            [0, ['0 seconds ago', '1 second ago']],
            [1, ['1 second ago', '2 seconds ago']],
            [2, ['2 seconds ago', '3 seconds ago']],
            [4, ['4 seconds ago', '5 seconds ago']],
            [6, ['6 seconds ago', '7 seconds ago']],
            [8, ['8 seconds ago', '8 seconds ago']],
            [10, ['10 seconds ago', '11 seconds ago']],
            [30, ['30 seconds ago', '31 seconds ago']],
            [58, ['58 seconds ago', '59 seconds ago']],
        ];
    }
}
