<?php

declare(strict_types=1);

namespace Serhii\Ago;

final readonly class LangForm
{
    public ?string $zero;
    public ?string $one;
    public ?string $few;
    public ?string $many;
    public string $other;

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
