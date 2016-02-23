<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Specialty;

/**
 * Class SpecialtyTransformer
 * @package namespace App\Transformers;
 */
class SpecialtyTransformer extends TransformerAbstract
{

    /**
     * Transform the \Specialty entity
     * @param Specialty $model
     *
     * @return array
     */
    public function transform(Specialty $model)
    {
        return [
            'name' => $model->name,
            'code' => $model->code
        ];
    }
}
