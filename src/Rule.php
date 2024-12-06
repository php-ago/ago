<?php

declare(strict_types=1);

namespace Serhii\Ago;

final readonly class Rule
{
    /**
     * This property is a default one for all the rules.
     * If all the fields will be false, then this one will be true.
     */
    public bool $other;

    public function __construct(
        public bool $zero,
        public bool $one,
        public bool $two,
        public bool $few,
        public bool $many,
    ) {
        $this->other = true;
    }
}
