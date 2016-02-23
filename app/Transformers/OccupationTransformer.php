<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Occupation;

/**
 * Class OccupationTransformer
 * @package namespace App\Transformers;
 */
class OccupationTransformer extends TransformerAbstract
{

    /**
     * Transform the \Occupation entity
     * @param Occupation $model
     *
     * @return array
     */
    public function transform(Occupation $model)
    {
        return [
            'date_of' => $model->date_of,
            'teacher' => $model->teacher->lastname,
            'troop' => $model->troop->code,
            'discipline' => $model->discipline->short_name,
            'audience' => $model->audience->location
        ];
    }
}
