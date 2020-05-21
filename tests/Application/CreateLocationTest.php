<?php

namespace App\Tests\Application;

use App\Service\LocationCreator;
use App\Tests\Domain\LocationMother;
use App\Tests\LocationUnitTestCase;

class CreateLocationTest extends LocationUnitTestCase
{
    /**
     * @var LocationCreator
     */
    private $creator;

    /** @test */
    public function it_should_create_a_location()
    {
        $location = LocationMother::random();

        $this->shouldSaveLocation($location);

        $this->creator->create($location->getName());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->creator = new LocationCreator($this->repository());
    }
}
