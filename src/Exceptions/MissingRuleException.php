<?php

declare(strict_types=1);

namespace Serhii\Ago\Exceptions;

use Exception;

class MissingRuleException extends Exception
{
    public function __construct(string $lang)
    {
        parent::__construct("Missing rule for language: {$lang}");
    }
}
