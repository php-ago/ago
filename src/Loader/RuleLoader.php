<?php

declare(strict_types=1);

namespace Serhii\Ago\Loader;

use RuntimeException;
use Serhii\Ago\Rule;

final readonly class RuleLoader
{
    public function __construct(private string $ruleDir)
    {
    }

    /**
     * @return array<string,Rule>
     */
    public function load(int $timeNum): array
    {
        $path = "{$this->ruleDir}/rules.php";

        if (!file_exists($path)) {
            throw new RuntimeException("[Ago]: File '{$path}' not found");
        }

        $closure = require $path;

        return $closure($timeNum);
    }
}
