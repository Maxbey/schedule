<?php

namespace App\Repositories\Additions;


use Illuminate\Database\Eloquent\ModelNotFoundException;

trait RestoreFunctionality
{
    public function restore($id)
    {
        return $this->findTrashed($id)->restore();
    }

    public function findTrashed($id)
    {
        $result = $this->model->onlyTrashed()->where('id', $id)->get();

        if(!$result->isEmpty())
        {
            return $result->first();
        }

        throw (new ModelNotFoundException)->setModel($this->model());
    }

    public function onlyTrashed()
    {
        return $this->model->onlyTrashed()->get();
    }
}