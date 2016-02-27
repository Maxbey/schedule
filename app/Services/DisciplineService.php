<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

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

    public function syncSpecialties($id, Collection $specialties)
    {
        return $this->getById($id)
            ->specialties()
            ->sync($specialties);
    }
}