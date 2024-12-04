<?php

declare(strict_types=1);

namespace Serhii\Ago;

final class LangSet
{
    public string $lang;
    public string $format;
    public string $ago;
    public string $online;
    public string $justNow;

    /** @var array<string,string> */
    public array $second;

    /** @var array<string,string> */
    public array $minute;

    /** @var array<string,string> */
    public array $hour;

    /** @var array<string,string> */
    public array $day;

    /** @var array<string,string> */
    public array $week;

    /** @var array<string,string> */
    public array $month;

    /** @var array<string,string> */
    public array $year;

    public function __construct(private Config $config)
    {
        $trans = $this->getTranslations();

        $this->lang = $trans['lang'];
        $this->format = $trans['format'];
        $this->ago = $trans['ago'];
        $this->online = $trans['online'];
        $this->justNow = $trans['justnow'];
        $this->second = $trans['second'];
        $this->minute = $trans['minute'];
        $this->hour = $trans['hour'];
        $this->day = $trans['day'];
        $this->week = $trans['week'];
        $this->month = $trans['month'];
        $this->year = $trans['year'];
    }

    /**
     * @return array<string,string|array<string,string>>
     */
    private function getTranslations(): array
    {
        $path = __DIR__ . "/../locales/{$this->config->lang->value}.php";
        return require $path;
    }
}
