<?php

declare(strict_types=1);

use Serhii\Ago\Rule;

/**
 * @return array<string,Rule>
 */
return static function (int $num): array {
    $end = $num % 10;

    return [
        'en,nl,de' => new Rule(
            zero: $num === 0,
            one: $num === 1,
            two: $num === 2,
            few: $num > 1,
            many: $num > 1,
        ),
        'ru,uk' => new Rule(
            zero: $num === 0,
            one: $num === 1 || ($num > 20 && $end === 1),
            two: $num === 2,
            few: ($end === 2 || $end === 3 || $end === 4) && ($num < 10 || $num > 20),
            many: ($num >= 5 && $num <= 20) || $end === 0 || $end >= 5,
        ),
        'zh' => new Rule(),
    ];
};
