<?php

namespace App\Services;

use Illuminate\Container\Container as Application;
use App\Repositories\Repository;

abstract class EntityService
{
    /**
     * @var \Illuminate\Container\Container
     */
    protected $app;

    /**
     * @var \App\Repositories\Repository
     */
    protected $repository;

    /**
     * Method must return the repository namespace
     *
     * @return string
     */
    protected abstract function repository();

    /**
     * EntityService constructor.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;

        $this->makeRepository();
    }

    /**
     * The method to create an instance of the repository
     *
     * @return Repository|mixed
     * @throws \Exception
     */
    protected function makeRepository()
    {
        $repository = $this->app->make($this->repository());

        if (!$repository instanceof Repository) {
            throw new \Exception("Class {$this->repository()} must be an instance of App\\Repositories\\Repository");
        }

        return $this->repository = $repository;
    }

    /**
     * Wrapper for findByIds repository method
     *
     * @param int $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Wrapper for find repository method
     *
     * @param array $ids
     * @return mixed
     */
    public function getByIds(array $ids)
    {
        return $this->repository->findByIds($ids);
    }

    /**
     * The method for updating their own entity attributes
     *
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function attributesUpdate($id, array $attributes)
    {
        $entity = $this->getById($id);

        return $this->repository->update($attributes, $id);
    }

    /**
     * Wrapper for delete repository method
     *
     * @param int $id
     * @return int
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    /**
     * Wrapper for restore repository method
     *
     * @param int $id
     * @return mixed
     */
    public function restore($id)
    {
        return $this->repository->restore($id);
    }
}