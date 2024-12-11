<?php

declare(strict_types=1);

use Serhii\Ago\LangForm;
use Serhii\Ago\LangSet;

return new LangSet(
    lang: "ru",
    format: "{num} {timeUnit} {ago}",
    ago: "назад",
    online: "В сети",
    justNow: "Только что",
    second: new LangForm(one: "секунда", few: "секунды", other: "секунд"),
    minute: new LangForm(one: "минута", few: "минуты", other: "минут"),
    hour: new LangForm(one: "час", few: "часа", other: "часов"),
    day: new LangForm(one: "день", few: "дня", other: "дней"),
    week: new LangForm(one: "неделя", few: "недели", other: "недель"),
    month: new LangForm(one: "месяц", few: "месяца", other: "месяцев"),
    year: new LangForm(one: "год", few: "года", other: "лет"),
);
