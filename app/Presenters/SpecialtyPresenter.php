<?php

namespace App\Presenters;

use App\Transformers\SpecialtyTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SpecialtyPresenter
 *
 * @package namespace App\Presenters;
 */
class SpecialtyPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SpecialtyTransformer();
    }
}
