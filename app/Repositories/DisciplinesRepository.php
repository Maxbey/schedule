<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

/**
 * Interface DisciplinesRepository
 * @package namespace App\Repositories;
 */
interface DisciplinesRepository extends RepositoryInterface
{
    public function findByFullName($fullName);

    public function findByShortName($shortName);
}
