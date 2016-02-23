<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface OccupationsRepository
 * @package namespace App\Repositories;
 */
interface OccupationsRepository extends RepositoryInterface
{
    public function findByDate($date);
}
