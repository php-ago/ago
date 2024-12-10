<?php

declare(strict_types=1);

namespace Serhii\Tests\Translations;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Serhii\Ago\Config;
use Serhii\Ago\Lang;
use Serhii\Ago\TimeAgo;

final class EnglishTest extends TestCase
{
    #[DataProvider('providerForReturnsCorrectTimeFromOneMinuteAndAbove')]
    public function testReturnsCorrectTimeFromOneMinuteAndAbove(string $input, string $expect): void
    {
        TimeAgo::reconfigure(new Config(lang: Lang::EN));
        $this->assertSame($expect, TimeAgo::trans($input));
    }

    public static function providerForReturnsCorrectTimeFromOneMinuteAndAbove(): array
    {
        return [
            ['now - 60 seconds', '1 minute ago'],
            ['now - 1 minute', '1 minute ago'],
            ['now - 2 minutes', '2 minutes ago'],
            ['now - 3 minutes', '3 minutes ago'],
            ['now - 4 minutes', '4 minutes ago'],
            ['now - 5 minutes', '5 minutes ago'],
            ['now - 11 minutes', '11 minutes ago'],
            ['now - 59 minutes', '59 minutes ago'],
            ['now - 60 minutes', '1 hour ago'],
            ['now - 1 hour', '1 hour ago'],
            ['now - 4 hours', '4 hours ago'],
            ['now - 13 hours', '13 hours ago'],
            ['now - 24 hours', '1 day ago'],
            ['now - 2 days', '2 days ago'],
            ['now - 7 days', '1 week ago'],
            ['now - 2 weeks', '2 weeks ago'],
            ['now - 1 month', '1 month ago'],
            ['now - 2 months', '2 months ago'],
            ['now - 11 months', '11 months ago'],
            ['now - 12 months', '1 year ago'],
            ['now - 5 years', '5 years ago'],
            ['now - 21 years', '21 years ago'],
            ['now - 31 years', '31 years ago'],
            ['now - 41 years', '41 years ago'],
            ['now - 100 years', '100 years ago'],
            ['now - 101 years', '101 years ago'],
        ];
    }

    #[DataProvider('providerForReturnsCorrectDateFrom0SecondsTo59Seconds')]
    public function testProviderForReturnsCorrectDateFrom0SecondsTo59Seconds(int $seconds, array $expect): void
    {
        TimeAgo::reconfigure(new Config(lang: Lang::EN));

        $result = TimeAgo::trans("now - {$seconds} seconds");
        $this->assertContains($result, $expect);
    }

    public static function providerForReturnsCorrectDateFrom0SecondsTo59Seconds(): array
    {
        return [
            [0, ['0 seconds ago', '1 second ago']],
            [1, ['1 second ago', '2 seconds ago']],
            [2, ['2 seconds ago', '3 seconds ago']],
            [30, ['30 seconds ago', '31 seconds ago']],
            [58, ['58 seconds ago', '59 seconds ago']],
        ];
    }
}
