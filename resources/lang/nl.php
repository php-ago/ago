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
    second: new LangForm(other: "seconden", one: "seconde"),
    minute: new LangForm(other: "minuten", one: "minuut"),
    hour: new LangForm(other: "uur", one: "uur"),
    day: new LangForm(other: "dagen", one: "dag"),
    week: new LangForm(other: "weken", one: "week"),
    month: new LangForm(other: "maanden", one: "maand"),
    year: new LangForm(other: "jaar", one: "jaar"),
);
