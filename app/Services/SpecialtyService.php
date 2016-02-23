<?php

namespace App\Services;


use App\Entities\Specialty;
use App\Repositories\DisciplinesRepository;
use App\Repositories\SpecialtiesRepository;
use App\Repositories\TroopsRepository;

class SpecialtyService
{
    protected $specialtiesRepository;

    public function __construct(SpecialtiesRepository $specialtiesRepository)
    {
        $this->specialtiesRepository = $specialtiesRepository;
    }

    public function getSpecialty($specialtyId)
    {
        return $this->specialtiesRepository->find($specialtyId);
    }

    public function create(array $attributes)
    {
        return $this->specialtiesRepository->create($attributes);
    }

    public function attachTroops($specialtyId, array $troops)
    {
        return $this->getSpecialty($specialtyId)
            ->troops()
            ->saveMany($troops);
    }

    public function attachDisciplines($specialtyId, array $disciplines)
    {
        return $this->getSpecialty($specialtyId)
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