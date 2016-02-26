<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

/**
 * Interface ThemesRepository
 * @package namespace App\Repositories;
 */
interface ThemesRepository extends RepositoryInterface
{
    public function findByTerm($termNumber);
}
