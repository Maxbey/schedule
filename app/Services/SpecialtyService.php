<?php

namespace App\Services;

use App\Entities\Specialty;
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
     * @param Specialty $specialty
     * @param Collection $disciplines
     * @return array
     */
    public function syncDisciplines(Specialty $specialty, Collection $disciplines)
    {
        return $specialty
            ->disciplines()
            ->sync($disciplines);
    }
}