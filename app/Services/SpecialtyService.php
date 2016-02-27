<?php

namespace App\Services;

use App\Repositories\SpecialtiesRepository;
use Illuminate\Database\Eloquent\Collection;

class SpecialtyService extends EntityService
{
    /**
     * Define repository.
     *
     * @return string
     */
    protected function repository()
    {
        return 'App\Repositories\SpecialtiesRepository';
    }

    /**
     * Create instance of Specialty
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->repository->create($attributes);
    }

    /**
     * Sync Disciplines through relation
     *
     * @param $specialtyId
     * @param Collection $disciplines
     * @return mixed
     */
    public function syncDisciplines($specialtyId, Collection $disciplines)
    {
        return $this->getById($specialtyId)
            ->disciplines()
            ->sync($disciplines);
    }
}