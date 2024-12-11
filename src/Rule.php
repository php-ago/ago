<?php

declare(strict_types=1);

namespace Serhii\Ago;

final class Rule
{
    public readonly bool $zero;
    public readonly bool $one;
    public readonly bool $two;
    public readonly bool $few;
    public readonly bool $many;

    /**
     * This property is a default one for all the rules.
     * If all the fields will be false, then this one will be true.
     */
    public bool $other;

    public function __construct(
        bool|null $zero = null,
        bool|null $one = null,
        bool|null $two = null,
        bool|null $few = null,
        bool|null $many = null,
    ) {
        $this->zero = $zero ?? false;
        $this->one = $one ?? false;
        $this->two = $two ?? false;
        $this->few = $few ?? false;
        $this->many = $many ?? false;
        $this->other = true;
    }
}
