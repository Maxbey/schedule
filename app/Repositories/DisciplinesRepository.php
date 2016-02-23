<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface DisciplinesRepository
 * @package namespace App\Repositories;
 */
interface DisciplinesRepository extends RepositoryInterface
{
    public function findByFullName($fullName);

    public function findByShortName($shortName);
}
