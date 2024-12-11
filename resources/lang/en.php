<?php

declare(strict_types=1);

use Serhii\Ago\Lang;
use Serhii\Ago\LangForm;
use Serhii\Ago\LangSet;

return new LangSet(
    lang: Lang::EN,
    format: '{num} {timeUnit} {ago}',
    ago: 'ago',
    online: 'Online',
    justNow: 'Just now',
    second: new LangForm(other: 'seconds', one: 'second'),
    minute: new LangForm(other: 'minutes', one: 'minute'),
    hour: new LangForm(other: 'hours', one: 'hour'),
    day: new LangForm(other: 'days', one: 'day'),
    week: new LangForm(other: 'weeks', one: 'week'),
    month: new LangForm(other: 'months', one: 'month'),
    year: new LangForm(other: 'years', one: 'year'),
);
