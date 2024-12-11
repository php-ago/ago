<?php

declare(strict_types=1);

use Serhii\Ago\LangForm;
use Serhii\Ago\LangSet;

return new LangSet(
    lang: "en",
    format: "{num} {timeUnit} {ago}",
    ago: "ago",
    online: "Online",
    justNow: "Just now",
    second: new LangForm(one: "second", other: "seconds"),
    minute: new LangForm(one: "minute", other: "minutes"),
    hour: new LangForm(one: "hour", other: "hours"),
    day: new LangForm(one: "day", other: "days"),
    week: new LangForm(one: "week", other: "weeks"),
    month: new LangForm(one: "month", other: "months"),
    year: new LangForm(one: "year", other: "years"),
);
