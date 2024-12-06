<?php

declare(strict_types=1);

namespace Serhii\Ago;

use DateTimeImmutable;
use DateTimeInterface;
use Serhii\Ago\Exceptions\InvalidDateFormatException;
use Serhii\Ago\Exceptions\InvalidOptionsException;
use Serhii\Ago\Exceptions\MissingRuleException;
use Serhii\Ago\Loader\LangLoader;
use Serhii\Ago\Loader\RuleLoader;

final class TimeAgo
{
    private static ?self $instance = null;

    /**
     * @var array<int,Option>
     */
    private array $options;
    private Config $config;
    private LangLoader $langLoader;
    private RuleLoader $ruleLoader;

    private function __construct()
    {
        $this->config = new Config();
        $this->langLoader = new LangLoader(__DIR__ . '/../resources/lang');
        $this->ruleLoader = new RuleLoader(__DIR__ . '/../resources');
    }

    public static function singleton(): self
    {
        return self::$instance ??= new self();
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
        return self::singleton()->transInternal($date, $options);
    }

    public static function configure(Config $config): void
    {
        self::singleton()->config = $config;
    }

    /**
     * @param array<int,Option> $options
     */
    private function transInternal(int|string|DateTimeInterface $date, array $options): string
    {
        $dateTime = match (true) {
            is_int($date) => $date,
            is_string($date) => (new DateTimeImmutable($date))->getTimestamp(),
            $date instanceof DateTimeInterface => $date->getTimestamp(),
        };

        return $this->handle($dateTime, $options);
    }

    /**
     * @param array<int,Option> $options
     */
    private function handle(int $dateTime, array $options): string
    {
        $this->options = $options;
        $this->validateOptions();

        $timeInSec = $this->computeTimeDifference($dateTime);

        $translations = $this->langLoader->load($this->config->lang);

        $langSet = new LangSet($translations);

        if ($this->config->customTranslations) {
            $langSet->applyCustomTranslations($this->config->customTranslations);
        }

        if ($this->isEnabled(Option::ONLINE) && $timeInSec < 60) {
            return $langSet->online;
        }

        if ($this->isEnabled(Option::JUST_NOW) && $timeInSec < 60) {
            return $langSet->justNow;
        }

        [$langForm, $timeNum] = $this->findLangForm($langSet, $timeInSec);

        $timeUnit = $this->computeTimeUnit($langForm, $timeNum);
        $suffix = $this->computeSuffix($langSet);

        return $this->mergeFinalOutput($timeNum, $timeUnit, $suffix, $langSet);
    }

    private function mergeFinalOutput(int $timeNum, string $timeUnit, string $suffix, LangSet $langSet): string
    {
        $result = str_replace(
            ['{timeUnit}', '{num}', '{ago}'],
            [$timeUnit, (string) $timeNum, $suffix],
            $langSet->format,
        );

        return trim($result);
    }

    private function computeTimeDifference(int $dateTime): int
    {
        $now = time();
        $result = $now - $dateTime;

        if ($result < 0) {
            $this->enableOption(Option::UPCOMING);
            return -$result;
        }

        return $result;
    }

    private function computeSuffix(LangSet $langSet): string
    {
        if ($this->isEnabled(Option::NO_SUFFIX) || $this->isEnabled(Option::UPCOMING)) {
            return '';
        }

        return $langSet->ago;
    }

    /**
     * @return array{LangForm,int}
     */
    private function findLangForm(LangSet $langSet, int $timeInSec): array
    {
        $timeNum = $this->calculateTimeNum($timeInSec);

        switch (true) {
            case $timeInSec < 60:
                return [$langSet->second, $timeNum->seconds];
            case $timeNum->minutes < 60:
                return [$langSet->minute, $timeNum->minutes];
            case $timeNum->hours < 24:
                return [$langSet->hour, $timeNum->hours];
            case $timeNum->days < 7:
                return [$langSet->day, $timeNum->days];
            case $timeNum->weeks < 4:
                return [$langSet->week, $timeNum->weeks];
            case $timeNum->months < 12:
                if ($timeNum->months === 0) {
                    return [$langSet->month, 1];
                }

                return [$langSet->month, $timeNum->months];
        }

        return [$langSet->year, $timeNum->years];
    }

    private function computeTimeUnit(LangForm $langForm, int $timeNum): string
    {
        $form = $this->timeUnitForm($timeNum);

        if (isset($langForm->{$form})) {
            return $langForm->{$form};
        }

        return $langForm->other;
    }

    private function timeUnitForm(int $timeNum): string
    {
        $rule = $this->identifyGrammarRules($timeNum);

        return match (true) {
            $rule->zero ?? false => 'zero',
            $rule->one ?? false => 'one',
            $rule->few ?? false => 'few',
            $rule->two ?? false => 'two',
            $rule->many ?? false => 'many',
            default => 'other',
        };
    }

    private function identifyGrammarRules(int $timeNum): Rule
    {
        $rules = $this->ruleLoader->load($timeNum);
        $lang = $this->config->lang->value;

        foreach ($rules as $langs => $rule) {
            if (str_contains($langs, $lang)) {
                return $rule;
            }
        }

        throw new MissingRuleException($lang);
    }

    private function calculateTimeNum(int $timeInSec): TimeNumber
    {
        return new TimeNumber(
            seconds: $timeInSec,
            minutes: (int) round($timeInSec / 60),
            hours: (int) round($timeInSec / 3600),
            days: (int) round($timeInSec / 86400),
            weeks: (int) round($timeInSec / 604800),
            months: (int) round($timeInSec / 2629440),
            years: (int) round($timeInSec / 31553280),
        );
    }

    private function isEnabled(Option $option): bool
    {
        return in_array($option, haystack: $this->options, strict: true);
    }

    private function enableOption(Option $option): void
    {
        if ($this->isEnabled($option)) {
            return;
        }

        $this->options[] = $option;
    }

    /**
     * @throws InvalidOptionsException
     */
    private function validateOptions(): void
    {
        if ($this->isEnabled(Option::JUST_NOW) && $this->isEnabled(Option::ONLINE)) {
            $msg = 'Option JUST_NOW and ONLINE are incompatible. Use only one of them';
            throw new InvalidOptionsException($msg);
        }
    }
}
