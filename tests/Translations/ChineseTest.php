<?php

declare(strict_types=1);

namespace Serhii\Tests\Translations;

use PHPUnit\Framework\Attributes\DataProvider;
use Serhii\Ago\Lang;
use Serhii\Ago\TimeAgo;
use Serhii\Tests\TestCase;

final class ChineseTest extends TestCase
{
    #[DataProvider('providerForReturnsCorrectTimeFromOneMinuteAndAbove')]
    public function testReturnsCorrectTimeFromOneMinuteAndAbove(string $input, string $expect): void
    {
        Lang::set(Lang::ZH);
        $this->assertSame($expect, TimeAgo::trans($input));
    }

    public static function providerForReturnsCorrectTimeFromOneMinuteAndAbove(): array
    {
        return [
            ['1 minute', '1分钟'],
            ['3 minutes', '3分钟'],
            ['1 hour', '1小时'],
            ['4 hours', '4小时'],
            ['1 day', '1天'],
            ['6 days', '6天'],
            ['1 week', '1周'],
            ['2 weeks', '2周'],
            ['1 month', '1个月'],
            ['8 months', '8个月'],
            ['1 year', '1年'],
            ['10 years', '10年'],
            ['-60 seconds', '1分钟前'],
            ['-1 minute', '1分钟前'],
            ['-2 minutes', '2分钟前'],
            ['-3 minutes', '3分钟前'],
            ['-4 minutes', '4分钟前'],
            ['-5 minutes', '5分钟前'],
            ['-11 minutes', '11分钟前'],
            ['-59 minutes', '59分钟前'],
            ['-60 minutes', '1小时前'],
            ['-1 hour', '1小时前'],
            ['-4 hours', '4小时前'],
            ['-13 hours', '13小时前'],
            ['-24 hours', '1天前'],
            ['-2 days', '2天前'],
            ['-7 days', '1周前'],
            ['-2 weeks', '2周前'],
            ['-1 month', '1个月前'],
            ['-2 months', '2个月前'],
            ['-11 months', '11个月前'],
            ['-12 months', '1年前'],
            ['-5 years', '5年前'],
            ['-7 years', '7年前'],
            ['-21 years', '21年前'],
            ['-31 years', '31年前'],
            ['-41 years', '41年前'],
            ['-100 years', '100年前'],
            ['-101 years', '101年前'],
        ];
    }

    #[DataProvider('providerForReturnsCorrectDateFrom0SecondsTo59Seconds')]
    public function testProviderForReturnsCorrectDateFrom0SecondsTo59Seconds(int $seconds, array $expect): void
    {
        Lang::set(Lang::ZH);

        $result = TimeAgo::trans("-{$seconds} seconds");
        $this->assertContains($result, $expect);
    }

    public static function providerForReturnsCorrectDateFrom0SecondsTo59Seconds(): array
    {
        return [
            [0, ['0秒前', '1秒前']],
            [1, ['1秒前', '2秒前']],
            [2, ['2秒前', '3秒前']],
            [4, ['4秒前', '5秒前']],
            [6, ['6秒前', '7秒前']],
            [8, ['8秒前', '9秒前']],
            [10, ['10秒前', '11秒前']],
            [30, ['30秒前', '31秒前']],
            [58, ['58秒前', '59秒前']],
        ];
    }
}
