<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

/**
 * Interface OccupationsRepository
 * @package namespace App\Repositories;
 */
interface OccupationsRepository extends RepositoryInterface
{
    public function findByDate($date);
}
