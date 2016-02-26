<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

/**
 * Interface AudiencesRepository
 * @package namespace App\Repositories;
 */
interface AudiencesRepository extends RepositoryInterface
{
    public function findByBuilding($building);

    public function findByNumber($number);
}
