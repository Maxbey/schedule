<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface as BaseInterface;

interface RepositoryInterface extends BaseInterface
{
    public function findByIds(array $ids);
}