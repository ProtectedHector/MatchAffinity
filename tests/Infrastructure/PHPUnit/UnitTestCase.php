<?php

namespace App\Tests\Infrastructure\PHPUnit;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;

abstract class UnitTestCase extends MockeryTestCase
{
    protected function mock($className): MockInterface
    {
        return Mockery::mock($className);
    }

    protected function namedMock($name, $className): MockInterface
    {
        return Mockery::namedMock($name, $className);
    }
}
