<?php

declare(strict_types=1);

use Serhii\Ago\Lang;
use Serhii\Ago\LangForm;
use Serhii\Ago\LangSet;

return new LangSet(
    lang: Lang::RU,
    format: "{num} {timeUnit} {ago}",
    ago: "назад",
    online: "В сети",
    justNow: "Только что",
    second: new LangForm(other: "секунд", one: "секунда", few: "секунды"),
    minute: new LangForm(other: "минут", one: "минута", few: "минуты"),
    hour: new LangForm(other: "часов", one: "час", few: "часа"),
    day: new LangForm(other: "дней", one: "день", few: "дня"),
    week: new LangForm(other: "недель", one: "неделя", few: "недели"),
    month: new LangForm(other: "месяцев", one: "месяц", few: "месяца"),
    year: new LangForm(other: "лет", one: "год", few: "года"),
);
