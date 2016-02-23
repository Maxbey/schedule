<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TeachersRepository
 * @package namespace App\Repositories;
 */
interface TeachersRepository extends RepositoryInterface
{
    public function findByLastName($lastName);
}
