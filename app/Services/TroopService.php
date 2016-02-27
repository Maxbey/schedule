<?php

namespace App\Services;


use App\Entities\Specialty;
use App\Repositories\TroopsRepository;

class TroopService extends EntityService
{
    /**
     * Define the repository
     *
     * @return string
     */
    protected function repository()
    {
        return 'App\Repositories\TroopsRepository';
    }

    /**
     * Create instance of Troop
     *
     * @param Specialty $specialty
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(Specialty $specialty, array $attributes)
    {
        return $specialty->troops()->create($attributes);
    }

    /**
     * Update Troop
     *
     * @param $id
     * @param Specialty $specialty
     * @param array $attributes
     * @return mixed
     */
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