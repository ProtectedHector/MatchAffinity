<?php

namespace App\Service;

use App\Entity\Location;
use App\Repository\LocationRepository;

class LocationCreator
{
    private $locationRepository;

    public function __construct(LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    public function create(string $name)
    {
        $location = Location::create($name);

        $this->locationRepository->save($location);
    }
}
