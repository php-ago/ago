<?php

declare(strict_types=1);

namespace Serhii\Ago;

final class Lang
{
    public const EN = 'en';
    public const RU = 'ru';
    public const UK = 'uk';
    public const NL = 'nl';
    public const DE = 'de';

    /**
     * @param array<int,LangOverwrite>|null $overwrites Overrides will override
     * default translations.
     */
    public static function set(string $lang, array|null $overwrites = []): void
    {
        TimeAgo::configure(new Config(lang: $lang, overwrites: $overwrites));
    }
}
