<?php

namespace App\Presenters;

use App\Transformers\DisciplineTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class DisciplinePresenter
 *
 * @package namespace App\Presenters;
 */
class DisciplinePresenter extends EntityPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new DisciplineTransformer();
    }
}
