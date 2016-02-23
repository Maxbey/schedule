<?php

namespace App\Repositories\Additions;


interface Restore
{
    public function restore($id);

    public function findTrashed($id);
}