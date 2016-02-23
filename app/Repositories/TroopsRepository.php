<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TroopsRepository
 * @package namespace App\Repositories;
 */
interface TroopsRepository extends RepositoryInterface
{
    public function findByCode($code);
}
