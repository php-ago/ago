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
     * @param array<int,LangOverride>|null $overrides Overrides will override
     * default translations.
     */
    public static function set(string $lang, array|null $overrides = []): void
    {
        TimeAgo::configure(new Config(lang: $lang, overrides: $overrides));
    }
}
