<?php

namespace App\Repository;

use App\Entity\Location;

interface LocationRepository
{
    public function save(Location $location);
}
