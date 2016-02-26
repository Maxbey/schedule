<?php

namespace App\Services;

class DisciplineService extends EntityService
{
    protected function repository()
    {
        return 'App\Repositories\DisciplinesRepository';
    }

    public function create(array $attributes)
    {
        return $this->repository->create($attributes);
    }
}