<?php

declare(strict_types=1);

use Serhii\Ago\Lang;
use Serhii\Ago\LangForm;
use Serhii\Ago\LangSet;

return new LangSet(
    lang: Lang::DE,
    format: "{ago} {num} {timeUnit}",
    ago: "Vor",
    online: "Online",
    justNow: "Soeben",
    second: new LangForm(other: "Sekunden", one: "Sekunde"),
    minute: new LangForm(other: "Minuten", one: "Minute"),
    hour: new LangForm(other: "Stunden", one: "Stunde"),
    day: new LangForm(other: "Tagen", one: "Tag"),
    week: new LangForm(other: "Wochen", one: "Woche"),
    month: new LangForm(other: "Monaten", one: "Monat"),
    year: new LangForm(other: "Jahren", one: "Jahr"),
);
