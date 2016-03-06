<?php

namespace App\Presenters;

use App\Transformers\AudienceTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AudiencePresenter
 *
 * @package namespace App\Presenters;
 */
class AudiencePresenter extends EntityPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AudienceTransformer();
    }
}
