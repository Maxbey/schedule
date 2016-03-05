<?php

namespace App\Presenters;


use Prettus\Repository\Presenter\FractalPresenter;

abstract class EntityPresenter extends FractalPresenter implements EntityPresenterInterface
{
    /**
     * This method force include relations into fractal manager.
     *
     * @param array $relations
     */
    public function includeRelations(array $relations)
    {
        $this->fractal->parseIncludes($relations);
    }
}