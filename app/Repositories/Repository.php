<?php

namespace App\Repositories;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Eloquent\BaseRepository;

abstract class Repository extends BaseRepository
{
    /**
     * The method to find all entities, the id which are contained in the array
     *
     * @param array $ids
     * @return mixed
     */
    public function findByIds(array $ids)
    {
        $collection = $this->findWhereIn('id', $ids);

        if(count($ids) !== $collection->count())
        {
            throw (new ModelNotFoundException)->setModel($this->model());
        }

        return $collection;
    }

}