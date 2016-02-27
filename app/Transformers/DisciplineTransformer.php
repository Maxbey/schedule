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

    protected $availableIncludes = [
        'specialties',
        'themes'
    ];

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
            'short_name' => $model->short_name,
            'links' => [
                'show' => route('api.disciplines.show', ['id' => $model->id]) . '?include=themes,specialties',
                'self' => route('api.disciplines.show', ['id' => $model->id])
            ]
        ];
    }

    public function includeSpecialties(Discipline $model)
    {
        $specialties = $model->specialties;

        return $this->collection($specialties, new SpecialtyTransformer);
    }

    public function includeThemes(Discipline $model)
    {
        $themes = $model->themes;

        return $this->collection($themes, new ThemeTransformer);
    }


}
