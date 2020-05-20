<?php

namespace App\Tests\Domain;

use PHPUnit\Framework\TestCase;

final class LocationTest extends TestCase
{
    /**
     * @test
     *
     * Simple test to check that there is no issue with PHPUnit
     * Using Object Mother Pattern
     */
    public function it_should_create_a_new_entity()
    {
        $location1 = LocationMother::withName('location1');
        $location2 = LocationMother::withName('location1');

        $this->assertEquals($location1, $location2);
    }
}
