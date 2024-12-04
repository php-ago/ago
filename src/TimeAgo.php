<?php

declare(strict_types=1);

namespace Serhii\Ago;

use Carbon\CarbonImmutable;
use DateTimeInterface;
use Serhii\Ago\Exceptions\InvalidDateFormatException;
use Serhii\Ago\Exceptions\InvalidOptionsException;
use Serhii\Ago\Exceptions\MissingRuleException;

final class TimeAgo
{
    /**
     * @var array<int,Option>
     */
    private array $options = [];
    private ?Config $config;
    private static ?self $instance = null;

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
     * @throws MissingRuleException
     * @throws InvalidDateFormatException
     * @throws InvalidOptionsException
     */
    public static function trans(int|string|DateTimeInterface $date, Option ...$options): string
    {
        $dateTime = match (true) {
            is_int($date) => CarbonImmutable::createFromTimestamp($date),
            is_string($date) => CarbonImmutable::parse($date),
            $date instanceof DateTimeInterface => CarbonImmutable::instance($date),
        };

        return self::singleton()->handle($dateTime, $options);
    }

    public static function configure(Config $config): void
    {
        self::singleton()->config = $config;
    }

    /**
     * @param array<int,Option> $options
     */
    private function handle(CarbonImmutable $dateTime, array $options): string
    {
        $this->options = $options;
        $this->validateOptions();

        $now = CarbonImmutable::now();
        $timeInSec = $dateTime->diffInSeconds($now);

        $langSet = new LangSet($this->config);

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
