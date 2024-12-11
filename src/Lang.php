<?php

declare(strict_types=1);

namespace Serhii\Ago;

final class Lang
{
    public const EN = 'en'; // English
    public const RU = 'ru'; // Russian
    public const UK = 'uk'; // Ukrainian
    public const NL = 'nl'; // Dutch
    public const DE = 'de'; // German
    public const ZH = 'zh'; // Chinese

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
