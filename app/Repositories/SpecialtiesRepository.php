<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface SpecialtiesRepository
 * @package namespace App\Repositories;
 */
interface SpecialtiesRepository extends RepositoryInterface
{
    public function findByName($name);

    public function findByCode($code);
}
