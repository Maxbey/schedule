<?php

namespace App\Presenters;

use App\Transformers\ThemeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ThemePresenter
 *
 * @package namespace App\Presenters;
 */
class ThemePresenter extends EntityPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ThemeTransformer();
    }
}
