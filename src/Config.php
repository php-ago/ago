<?php

declare(strict_types=1);

namespace Serhii\Ago;

class Config
{
    public function __construct(public readonly Lang $lang = Lang::EN)
    {
    }
}
