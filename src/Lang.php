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
     * @see https://en.wikipedia.org/wiki/List_of_ISO_639_language_codes
     *
     * Set the language by passing ISO 639-1 language code like 'ru', 'en',
     * etc. It's recommended to use constants from this class to set the language
     * like Lang::RU, Lang::EN, Lang::DE, etc.
     * Default is English (Lang::EN).
     *
     */
    public static function set(string $lang): void
    {
        TimeAgo::configure(new Config(lang: $lang));
    }
}
