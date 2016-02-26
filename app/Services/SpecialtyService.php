<?php

namespace App\Services;

use App\Repositories\SpecialtiesRepository;
use Illuminate\Database\Eloquent\Collection;

class SpecialtyService
{
    protected $specialtiesRepository;

    public function __construct(SpecialtiesRepository $specialtiesRepository)
    {
        $this->specialtiesRepository = $specialtiesRepository;
    }

    public function getById($specialtyId)
    {
        return $this->specialtiesRepository->find($specialtyId);
    }

    public function getByIds(array $ids)
    {
        return $this->specialtiesRepository->findByIds($ids);
    }

    public function create(array $attributes)
    {
        return $this->specialtiesRepository->create($attributes);
    }

    public function syncDisciplines($specialtyId, Collection $disciplines)
    {
        return $this->getById($specialtyId)
            ->disciplines()
            ->sync($disciplines);
    }

    public function delete($specialtyId)
    {
        return $this->specialtiesRepository->delete($specialtyId);
    }

    public function restore($specialtyId)
    {
        return $this->specialtiesRepository->restore($specialtyId);
    }

}