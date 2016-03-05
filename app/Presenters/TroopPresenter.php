<?php

namespace App\Presenters;

use App\Transformers\TroopTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TroopPresenter
 *
 * @package namespace App\Presenters;
 */
class TroopPresenter extends EntityPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TroopTransformer();
    }
}
