<?php

namespace App\Services;


use App\Repositories\DisciplinesRepository;

class DisciplineService
{
    protected $disciplinesRepository;

    public function __construct(DisciplinesRepository $disciplinesRepository)
    {
        $this->disciplinesRepository = $disciplinesRepository;
    }

    public function create(array $attributes)
    {
        return $this->disciplinesRepository->create($attributes);
    }

    public function delete($disciplineId)
    {
        return $this->disciplinesRepository->delete($disciplineId);
    }

    public function restore($disciplineId)
    {
        return $this->disciplinesRepository->restore($disciplineId);
    }

    public function getByIds(array $ids)
    {
        return $this->disciplinesRepository->findWhereIn('id', $ids);
    }

}