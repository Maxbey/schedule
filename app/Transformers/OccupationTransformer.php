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
            'teacher' => $model->teacherName,
            'troop' => $model->troopCode,
            'discipline' => $model->disciplineName,
            'audience' => $model->audienceLocation,
            'theme' => $model->themeName,
            'links' => [
                'show' => route('api.occupations.show', ['id' => $model->id]),
                'self' => route('api.occupations.show', ['id' => $model->id]),
            ]
        ];
    }
}
