<?php

namespace App\Services;


use App\Entities\Specialty;
use App\Repositories\TroopsRepository;

class TroopService
{
    protected $troopsRepository;

    public function __construct(TroopsRepository $troopsRepository)
    {
        $this->troopsRepository = $troopsRepository;
    }

    public function create(Specialty $specialty, array $attributes)
    {
        return $specialty->troops()->create($attributes);
    }

    public function delete($troopId)
    {
        return $this->troopsRepository->delete($troopId);
    }

    public function restore($troopId)
    {
        return $this->troopsRepository->restore($troopId);
    }

}