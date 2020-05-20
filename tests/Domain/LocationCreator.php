<?php

namespace App\Tests\Domain;

use Faker\Factory;

class LocationCreator
{
    private static $faker;

    public static function random()
    {
        return self::faker();
    }

    protected static function faker()
    {
        return self::$faker = self::$faker ?: Factory::create();
    }
}
