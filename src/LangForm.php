<?php

declare(strict_types=1);

namespace Serhii\Ago;

final class LangForm
{
    public function __construct(
        public readonly string $other,
        public readonly string|null $zero = null,
        public readonly string|null $one = null,
        public readonly string|null $few = null,
        public readonly string|null $many = null,
    ) {
    }
}
