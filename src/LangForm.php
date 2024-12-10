<?php

declare(strict_types=1);

namespace Serhii\Ago;

final readonly class LangForm
{
    public function __construct(
        public string $other,
        public string|null $zero = null,
        public string|null $one = null,
        public string|null $few = null,
        public string|null $many = null,
    ) {
    }
}
