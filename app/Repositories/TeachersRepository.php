<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

/**
 * Interface TeachersRepository
 * @package namespace App\Repositories;
 */
interface TeachersRepository extends RepositoryInterface
{
    public function findByLastName($lastName);
}
