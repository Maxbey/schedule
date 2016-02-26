<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

/**
 * Interface TroopsRepository
 * @package namespace App\Repositories;
 */
interface TroopsRepository extends RepositoryInterface
{
    public function findByCode($code);
}
