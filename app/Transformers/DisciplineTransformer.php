<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Discipline;

/**
 * Class DisciplineTransformer
 * @package namespace App\Transformers;
 */
class DisciplineTransformer extends TransformerAbstract
{

    /**
     * Transform the \Discipline entity
     * @param Discipline $model
     *
     * @return array
     */
    public function transform(Discipline $model)
    {
        return [
            'full_name' => $model->full_name,
            'short_name' => $model->short_name
        ];
    }
}
