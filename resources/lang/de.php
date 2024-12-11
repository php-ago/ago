<?php

declare(strict_types=1);

use Serhii\Ago\LangForm;
use Serhii\Ago\LangSet;

return new LangSet(
    lang: "de",
    format: "{ago} {num} {timeUnit}",
    ago: "Vor",
    online: "Online",
    justNow: "Soeben",
    second: new LangForm(one: "Sekunde", other: "Sekunden"),
    minute: new LangForm(one: "Minute", other: "Minuten"),
    hour: new LangForm(one: "Stunde", other: "Stunden"),
    day: new LangForm(one: "Tag", other: "Tagen"),
    week: new LangForm(one: "Woche", other: "Wochen"),
    month: new LangForm(one: "Monat", other: "Monaten"),
    year: new LangForm(one: "Jahr", other: "Jahren"),
);
