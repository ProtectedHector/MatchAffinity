<?php

namespace App\Tests;

use App\Entity\Location;
use App\Repository\LocationRepository;
use App\Tests\Infrastructure\PHPUnit\UnitTestCase;
use Mockery\MockInterface;

class LocationUnitTestCase extends UnitTestCase
{
    private $repository;

    protected function shouldSaveLocation(Location $location)
    {
        $this->repository()
            ->shouldReceive('save')
            ->with(\PHPUnit\Framework\equalTo($location))
            ->once()
            ->andReturnNull();
    }

    /** @return LocationRepository|MockInterface */
    protected function repository()
    {
        return $this->repository = $this->repository ?: $this->mock(LocationRepository::class);
    }
}
