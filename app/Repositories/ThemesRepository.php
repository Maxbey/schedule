<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ThemesRepository
 * @package namespace App\Repositories;
 */
interface ThemesRepository extends RepositoryInterface
{
    public function findByTerm($termNumber);
}
