<?php

declare(strict_types=1);

namespace Serhii\Tests;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Serhii\Ago\TimeAgo;

class TestCase extends PHPUnitTestCase
{
    public function tearDown(): void
    {
        TimeAgo::reconfigure();
        parent::tearDown();
    }
}
