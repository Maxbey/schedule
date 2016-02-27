<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

class DisciplineService extends EntityService
{
    /**
     * Define repository.
     *
     * @return string
     */
    protected function repository()
    {
        return 'App\Repositories\DisciplinesRepository';
    }

    /**
     * Create instance of Discipline
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->repository->create($attributes);
    }

    /**
     * Sync Specialties through relation
     *
     * @param int $id
     * @param Collection $specialties
     * @return mixed
     */
    public function syncSpecialties($id, Collection $specialties)
    {
        return $this->getById($id)
            ->specialties()
            ->sync($specialties);
    }
}