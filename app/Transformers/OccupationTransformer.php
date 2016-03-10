<?php

namespace App\Transformers;

use App\Entities\Theme;
use League\Fractal\TransformerAbstract;
use App\Entities\Occupation;

/**
 * Class OccupationTransformer
 * @package namespace App\Transformers;
 */
class OccupationTransformer extends TransformerAbstract
{
    /**
     * Relations
     *
     * @var array
     */
    protected $availableIncludes = [
        'teachers',
        'audiences'
    ];

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
            'troop' => $model->troopCode,
            'theme' => $model->themeName,
            'links' => [
                'self' => route('api.occupations.show', ['id' => $model->id])
            ]
        ];
    }

    /**
     * Teachers relation
     *
     * @param Theme $model
     * @return \League\Fractal\Resource\Collection
     */
    public function includeTeachers(Theme $model)
    {
        $teachers = $model->teachers;

        return $this->collection($teachers, new TeacherTransformer);
    }

    /**
     * Audiences relation
     *
     * @param Theme $model
     * @return \League\Fractal\Resource\Collection
     */
    public function includeAudiences(Theme $model)
    {
        $audiences = $model->audiences;

        return $this->collection($audiences, new AudienceTransformer);
    }
}
