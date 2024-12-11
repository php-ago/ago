<?php

declare(strict_types=1);

use Serhii\Ago\Lang;
use Serhii\Ago\LangForm;
use Serhii\Ago\LangSet;

return new LangSet(
    lang: Lang::ZH,
    format: '{num}{timeUnit}{ago}',
    ago: '前',
    online: '在线',
    justNow: '刚刚',
    second: new LangForm(other: '秒'),
    minute: new LangForm(other: '分钟'),
    hour: new LangForm(other: '小时'),
    day: new LangForm(other: '天'),
    week: new LangForm(other: '周'),
    month: new LangForm(other: '个月'),
    year: new LangForm(other: '年'),
);
