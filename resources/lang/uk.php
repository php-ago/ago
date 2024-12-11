<?php

declare(strict_types=1);

use Serhii\Ago\Lang;
use Serhii\Ago\LangForm;
use Serhii\Ago\LangSet;

return new LangSet(
    lang: Lang::UK,
    format: "{num} {timeUnit} {ago}",
    ago: "тому",
    online: "В мережі",
    justNow: "Щойно",
    second: new LangForm(other: "секунд", one: "секунда", few: "секунди"),
    minute: new LangForm(other: "хвилин", one: "хвилина", few: "хвилини"),
    hour: new LangForm(other: "годин", one: "година", few: "години"),
    day: new LangForm(other: "дні", one: "день", few: "дні", many: "днів"),
    week: new LangForm(other: "тижнів", one: "тиждень", few: "тижні"),
    month: new LangForm(other: "місяців", one: "місяць", few: "місяці"),
    year: new LangForm(other: "років", one: "рік", few: "роки"),
);
