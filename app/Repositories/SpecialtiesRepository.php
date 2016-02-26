<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

/**
 * Interface SpecialtiesRepository
 * @package namespace App\Repositories;
 */
interface SpecialtiesRepository extends RepositoryInterface
{
    public function findByName($name);

    public function findByCode($code);
}
