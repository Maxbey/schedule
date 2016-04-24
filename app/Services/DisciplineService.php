<?php

namespace App\Services;

use App\Entities\Discipline;
use App\Entities\Troop;
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
     * @param Discipline $discipline
     * @param Collection $specialties
     * @return mixed
     */
    public function syncSpecialties(Discipline $discipline, Collection $specialties)
    {
        return $discipline
            ->specialties()
            ->sync($specialties);
    }

}