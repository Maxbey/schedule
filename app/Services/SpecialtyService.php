<?php

namespace App\Services;

use App\Repositories\SpecialtiesRepository;
use Illuminate\Database\Eloquent\Collection;

class SpecialtyService extends EntityService
{
    protected function repository()
    {
        return 'App\Repositories\SpecialtiesRepository';
    }

    public function create(array $attributes)
    {
        return $this->repository->create($attributes);
    }

    public function syncDisciplines($specialtyId, Collection $disciplines)
    {
        return $this->getById($specialtyId)
            ->disciplines()
            ->sync($disciplines);
    }
}