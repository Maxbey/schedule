<?php

namespace App\Presenters;


interface EntityPresenterInterface
{
    /**
     * This method force include relations through fractal manager.
     *
     * @param array $relations
     */
    public function includeRelations(array $relations);
}