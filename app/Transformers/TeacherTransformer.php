<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Teacher;

/**
 * Class TeacherTransformer
 * @package namespace App\Transformers;
 */
class TeacherTransformer extends TransformerAbstract
{

    /**
     * Transform the \Teacher entity
     * @param Teacher $model
     *
     * @return array
     */
    public function transform(Teacher $model)
    {
        return [
            'name' => $model->fullName,
            'rank' => $model->military_rank
        ];
    }
}
