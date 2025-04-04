<?php

declare(strict_types=1);

namespace Serhii\Ago;

use DateTimeInterface;
use InvalidArgumentException;
use RuntimeException;
use Serhii\Ago\Exceptions\InvalidOptionsException;
use Serhii\Ago\Exceptions\MissingRuleException;
use Serhii\Ago\Loader\LangLoader;
use Serhii\Ago\Loader\RuleLoader;

final class TimeAgo
{
    private static ?self $instance = null;

    /**
     * @var Option[]
     */
    private array $options;
    private Config $config;
    private LangLoader $langLoader;
    private RuleLoader $ruleLoader;
    private TimeDecomposer $timeDecomposer;

    private function __construct()
    {
        $this->config = new Config();
        $this->langLoader = new LangLoader(__DIR__ . '/../resources/lang');
        $this->ruleLoader = new RuleLoader(__DIR__ . '/../resources');
        $this->timeDecomposer = new TimeDecomposer();
    }

    public static function singleton(): self
    {
        return self::$instance ??= new self();
    }

    /**
     * Takes date string and returns converted and translated date
     *
     * @throws MissingRuleException
     * @throws InvalidOptionsException
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public static function trans(int|string|DateTimeInterface $date, Option ...$options): string
    {
        return self::singleton()->transInternal($date, $options);
    }

    public static function configure(Config $config): void
    {
        $inst = self::singleton();

        if ($config->hasCustomLang) {
            $inst->config->lang = $config->lang;
        }

        if ($config->hasCustomOverwrites) {
            $inst->config->overwrites = array_merge($inst->config->overwrites, $config->overwrites);
        }
    }

    public static function reconfigure(Config|null $config = null): void
    {
        self::singleton()->config = $config ?? new Config();
    }

    /**
     * @param Option[] $options
     *
     * @throws MissingRuleException
     * @throws InvalidOptionsException
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    private function transInternal(int|string|DateTimeInterface $date, array $options): string
    {
        $dateTime = match (true) {
            is_int($date) => $date,
            is_string($date) => strtotime($date),
            $date instanceof DateTimeInterface => $date->getTimestamp(),
        };

        if ($dateTime === false) {
            throw new InvalidArgumentException('[Ago]: Invalid date format');
        }

        return $this->handle($dateTime, $options);
    }

    /**
     * @param Option[] $options
     *
     * @throws MissingRuleException
     * @throws InvalidOptionsException
     * @throws RuntimeException
     */
    private function handle(int $dateTime, array $options): string
    {
        $this->handleOptions($options);

        $timeInSec = $this->computeTimeDifference($dateTime);
        $langSet = $this->langLoader->load($this->config->lang);

        if (!empty($this->config->overwrites)) {
            $langSet->applyOverwrites($this->config);
        }

        if ($timeInSec < 60 && $this->isEnabled(Option::ONLINE)) {
            return $langSet->online;
        }

        if ($timeInSec < 60 && $this->isEnabled(Option::JUST_NOW)) {
            return $langSet->justNow;
        }

        [$langForm, $timeNum] = $this->findLangForm($langSet, $timeInSec);

        $timeUnit = $this->computeTimeUnit($langForm, $timeNum);
        $suffix = $this->computeSuffix($langSet);

        return $this->mergeFinalOutput($timeNum, $timeUnit, $suffix, $langSet);
    }

    /**
     * @param Option[] $options
     *
     * @throws InvalidOptionsException
     */
    private function handleOptions(array $options): void
    {
        $this->options = $options;
        $this->validateOptions();

        if ($this->isEnabled(Option::RESET_CONF)) {
            $this->config = new Config();
        }
    }

    private function mergeFinalOutput(int $timeNum, string $timeUnit, string $suffix, LangSet $langSet): string
    {
        $finalOutput = str_replace(
            ['{timeUnit}', '{num}', '{ago}'],
            [$timeUnit, (string) $timeNum, $suffix],
            $langSet->format,
        );

        return trim($finalOutput);
    }

    private function computeTimeDifference(int $dateTime): int
    {
        $diff = time() - $dateTime;

        if ($diff < 0) {
            $this->enableUpcomingOption();
            return -$diff;
        }

        return $diff;
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
     *
     * @throws RuntimeException
     */
    private function findLangForm(LangSet $langSet, int $timeInSec): array
    {
        $timeNum = $this->timeDecomposer->calculateTimeNum($timeInSec);

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

    /**
     * @throws MissingRuleException
     */
    private function computeTimeUnit(LangForm $langForm, int $timeNum): string
    {
        $form = $this->timeUnitForm($timeNum);
        $matchedForm = $langForm->{$form};

        return is_string($matchedForm) ? $matchedForm : $langForm->other;
    }

    /**
     * @throws MissingRuleException
     */
    private function timeUnitForm(int $timeNum): string
    {
        $rule = $this->identifyGrammarRules($timeNum);

        return match (true) {
            $rule->zero => 'zero',
            $rule->one => 'one',
            $rule->few => 'few',
            $rule->two => 'two',
            $rule->many => 'many',
            default => 'other',
        };
    }

    /**
     * @throws MissingRuleException
     */
    private function identifyGrammarRules(int $timeNum): Rule
    {
        $rules = $this->ruleLoader->load($timeNum);
        $lang = $this->config->lang;

        foreach ($rules as $languages => $rule) {
            if (str_contains($languages, $lang)) {
                return $rule;
            }
        }

        throw new MissingRuleException($lang);
    }

    private function isEnabled(Option $option): bool
    {
        return in_array($option, haystack: $this->options, strict: true);
    }

    private function enableUpcomingOption(): void
    {
        if ($this->isEnabled(Option::UPCOMING)) {
            return;
        }

        $this->options[] = Option::UPCOMING;
    }

    /**
     * @throws InvalidOptionsException
     */
    private function validateOptions(): void
    {
        if ($this->isEnabled(Option::JUST_NOW) && $this->isEnabled(Option::ONLINE)) {
            $msg = '[Ago]: Option JUST_NOW and ONLINE are incompatible. Use only one of them';
            throw new InvalidOptionsException($msg);
        }
    }
}
