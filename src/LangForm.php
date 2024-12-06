<?php

declare(strict_types=1);

namespace Serhii\Ago;

final class LangForm
{
    public readonly ?string $zero;
    public readonly ?string $one;
    public readonly ?string $few;
    public readonly ?string $many;
    public readonly string $other;

    /**
     * @param array<string,string> $translations
     */
    public function __construct(array $translations)
    {
        $this->zero = $translations['zero'] ?? null;
        $this->one = $translations['one'] ?? null;
        $this->few = $translations['few'] ?? null;
        $this->many = $translations['many'] ?? null;
        $this->other = $translations['other'];
    }
}
