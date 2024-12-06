<?php

declare(strict_types=1);

namespace Serhii\Ago;

final class Rule
{
    public readonly bool $other;

    public function __construct(
        public readonly bool $zero,
        public readonly bool $one,
        public readonly bool $two,
        public readonly bool $few,
        public readonly bool $many,
        bool|null $other = null,
    ) {
        $this->other = $other ?? true;
    }
}
