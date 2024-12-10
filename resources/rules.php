<?php

declare(strict_types=1);

use Serhii\Ago\Lang;
use Serhii\Ago\Rule;

/**
 * @return Rule[]
 */
return static function (int $num): array {
    $end = $num % 10;

    return [
        new Rule(
            langs: [Lang::EN, Lang::NL, Lang::DE],
            zero: $num === 0,
            one: $num === 1,
            two: $num === 2,
            few: $num > 1,
            many: $num > 1,
        ),
        new Rule(
            langs: [Lang::RU, Lang::UK],
            zero: $num === 0,
            one: $num === 1 || ($num > 20 && $end === 1),
            two: $num === 2,
            few: ($end === 2 || $end === 3 || $end === 4) && ($num < 10 || $num > 20),
            many: ($num >= 5 && $num <= 20) || $end === 0 || $end >= 5,
        ),
        // 'zh,ja' => new Rule(
        //     zero: true,
        //     one: true,
        //     two: true,
        //     few: true,
        //     many: true,
        // ),
    ];
};
