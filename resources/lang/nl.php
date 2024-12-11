<?php

declare(strict_types=1);

use Serhii\Ago\Lang;
use Serhii\Ago\LangForm;
use Serhii\Ago\LangSet;

return new LangSet(
    lang: Lang::NL,
    format: "{num} {timeUnit} {ago}",
    ago: "geleden",
    online: "Online",
    justNow: "Net nu",
    second: new LangForm(one: "seconde", other: "seconden"),
    minute: new LangForm(one: "minuut", other: "minuten"),
    hour: new LangForm(one: "uur", other: "uur"),
    day: new LangForm(one: "dag", other: "dagen"),
    week: new LangForm(one: "week", other: "weken"),
    month: new LangForm(one: "maand", other: "maanden"),
    year: new LangForm(one: "jaar", other: "jaar"),
);
