<?php

declare(strict_types=1);

namespace Serhii\Ago;

final class Rule
{
    /**
     * This property is a default one for all the rules.
     * If all the fields will be false, then this one will be true.
     */
    public bool $other;

    public function __construct(
        public readonly bool $zero,
        public readonly bool $one,
        public readonly bool $two,
        public readonly bool $few,
        public readonly bool $many,
    ) {
        $this->other = true;
    }
}
