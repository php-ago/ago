<?php

declare(strict_types=1);

use Serhii\Ago\LangForm;
use Serhii\Ago\LangSet;

return new LangSet(
    lang: "uk",
    format: "{num} {timeUnit} {ago}",
    ago: "тому",
    online: "В мережі",
    justNow: "Щойно",
    second: new LangForm(one: "секунда", few: "секунди", other: "секунд"),
    minute: new LangForm(one: "хвилина", few: "хвилини", other: "хвилин"),
    hour: new LangForm(one: "година", few: "години", other: "годин"),
    day: new LangForm(one: "день", few: "дні", many: "днів", other: "дні"),
    week: new LangForm(one: "тиждень", few: "тижні", other: "тижнів"),
    month: new LangForm(one: "місяць", few: "місяці", other: "місяців"),
    year: new LangForm(one: "рік", few: "роки", other: "років"),
);
