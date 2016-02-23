<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface AudiencesRepository
 * @package namespace App\Repositories;
 */
interface AudiencesRepository extends RepositoryInterface
{
    public function findByBuilding($building);

    public function findByNumber($number);
}
