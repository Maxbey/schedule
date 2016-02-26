<?php

namespace App\Services;


use App\Repositories\DisciplinesRepository;

class DisciplineService extends EntityService
{
    protected function repository()
    {
        return 'App\Repositories\DisciplinesRepository';
    }

    public function create(array $attributes)
    {
        return $this->disciplinesRepository->create($attributes);
    }
}