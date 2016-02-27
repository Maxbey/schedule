<?php

namespace App\Repositories\Additions;


use Illuminate\Database\Eloquent\ModelNotFoundException;

trait RestoreFunctionality
{
    /**
     * Restore entity in storage
     * @param int $id
     * @return mixed
     */
    public function restore($id)
    {
        return $this->findTrashed($id)->restore();
    }

    /**
     * Found among remote entities
     *
     * @param int $id
     * @return mixed
     */
    public function findTrashed($id)
    {
        $result = $this->model->onlyTrashed()->where('id', $id)->get();

        if(!$result->isEmpty())
        {
            return $result->first();
        }

        throw (new ModelNotFoundException)->setModel($this->model());
    }

    /**
     * Get all trashed entities
     *
     * @return mixed
     */
    public function onlyTrashed()
    {
        return $this->model->onlyTrashed()->get();
    }
}