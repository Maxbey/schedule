<?php

namespace App\Services;

use Illuminate\Container\Container as Application;
use App\Repositories\Repository;

abstract class EntityService
{
    protected $app;

    protected $repository;

    protected abstract function repository();

    public function __construct(Application $app)
    {
        $this->app = $app;

        $this->makeRepository();
    }

    protected function makeRepository()
    {
        $repository = $this->app->make($this->repository());

        if (!$repository instanceof Repository) {
            throw new \Exception("Class {$this->repository()} must be an instance of App\\Repositories\\Repository");
        }

        return $this->repository = $repository;
    }

    public function getById($id)
    {
        return $this->repository->find($id);
    }

    public function getByIds(array $ids)
    {
        return $this->repository->findWhereIn('id', $ids);
    }

    public function update($id, array $attributes)
    {
        $entity = $this->getById($id);

        return $this->repository->update($attributes, $id);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function restore($id)
    {
        return $this->repository->restore($id);
    }
}