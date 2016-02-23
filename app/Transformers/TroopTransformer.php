<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Troop;

/**
 * Class TroopTransformer
 * @package namespace App\Transformers;
 */
class TroopTransformer extends TransformerAbstract
{

    /**
     * Transform the \Troop entity
     * @param Troop $model
     *
     * @return array
     */
    public function transform(Troop $model)
    {
        return [
            'code' => $model->code,
            'specialty' => $model->specialtyName
        ];
    }
}
