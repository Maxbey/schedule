<?php

namespace App\Repositories;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Eloquent\BaseRepository;

abstract class Repository extends BaseRepository
{
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