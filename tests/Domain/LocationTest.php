<?php

namespace App\Tests\Domain;

use App\Entity\Location;
use PHPUnit\Framework\TestCase;

final class LocationTest extends TestCase
{
    /**
     * @test
     *
     * Simple test to check that there is no issue with PHPUnit
     */
    public function shouldCreateNewEntity()
    {
        $location1 = new Location('location1');
        $location2 = new Location('location1');

        $this->assertEquals($location1, $location2);
    }
}
