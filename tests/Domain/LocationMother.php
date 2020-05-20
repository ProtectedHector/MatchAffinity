<?php

namespace App\Tests\Domain;

use App\Entity\Location;

// @TODO: Implement with Value Object
// https://martinfowler.com/bliki/ValueObject.html
class LocationMother
{
    public static function random(): Location
    {
        return self::create(
            LocationCreator::random()->name
        );
    }

    public static function create($name): Location
    {
        return new Location($name);
    }

    public static function withName(string $name)
    {
        return self::create($name);
    }
}
