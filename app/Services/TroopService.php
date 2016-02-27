<?php

namespace App\Services;


use App\Entities\Specialty;
use App\Repositories\TroopsRepository;

class TroopService extends EntityService
{
    protected function repository()
    {
        return 'App\Repositories\TroopsRepository';
    }

    public function create(Specialty $specialty, array $attributes)
    {
        return $specialty->troops()->create($attributes);
    }

    public function update($id, Specialty $specialty, array $attributes)
    {
        $troop = $this->getById($id)
            ->fill($attributes);

        $troop->specialty()
            ->associate($specialty)
            ->save();

        return $troop;
    }

}