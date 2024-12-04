<?php

declare(strict_types=1);

namespace Serhii\Ago;

use DateTimeInterface;
use Serhii\Ago\Exceptions\InvalidDateFormatException;
use Serhii\Ago\Exceptions\InvalidOptionsException;
use Serhii\Ago\Exceptions\MissingRuleException;

final class TimeAgo
{
    /**
     * @var Option[]
     */
    private static array $options = [];

    private static Config|null $config;

    private static self|null $instance = null;

    private function __construct()
    {
    }

    public static function singleton(): self
    {
        return self::$instance ?? (self::$instance = new self());
    }

    /**
     * Takes date string and returns converted and translated date
     *
     * @param int[]|int|null $options
     *
     * @throws MissingRuleException
     * @throws InvalidDateFormatException
     * @throws InvalidOptionsException
     */
    public static function trans(
        int|string|DateTimeInterface|null $date,
        array|int $options = [],
    ): string {
        return self::singleton()->handle();
    }

    public static function configure(Config $config): void
    {
        self::$config = $config;
    }

    private function handle(): string
    {
        return '';
    }

    private function optionIsSet(Option $option): bool
    {
        return in_array($option, haystack: $this->options, strict: true);
    }

    /**
     * @throws InvalidOptionsException
     */
    private function validateOptions(): void
    {
        if ($this->optionIsSet(Option::JUST_NOW) && $this->optionIsSet(Option::ONLINE)) {
            $msg = 'Option JUST_NOW and ONLINE are incompatible. Use only one of them';
            throw new InvalidOptionsException($msg);
        }
    }
}
