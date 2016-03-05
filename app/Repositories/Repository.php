<?php

namespace App\Repositories;


use App\Presenters\EntityPresenterInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Eloquent\BaseRepository;

abstract class Repository extends BaseRepository
{
    /**
     * @var EntityPresenterInterface
     */
    protected $presenter;

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

    /**
     * Include relations through Presenter
     *
     * @param array $relations
     * @return Repository
     */
    public function withRelations(array $relations)
    {
        $this->presenter->includeRelations($relations);

        return $this;
    }

}