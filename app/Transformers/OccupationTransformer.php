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
     * Relations
     *
     * @var array
     */
    protected $availableIncludes = [
        'teachers',
        'audiences',
        'theme'
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
            'discipline_name' => $model->disciplineName,
            'links' => [
                'self' => route('api.occupations.show', ['id' => $model->id])
            ]
        ];
    }

    /**
     * Teachers relation
     *
     * @param Occupation $model
     * @return \League\Fractal\Resource\Collection
     */
    public function includeTeachers(Occupation $model)
    {
        $teachers = $model->teachers;

        return $this->collection($teachers, new TeacherTransformer);
    }

    /**
     * Audiences relation
     *
     * @param Occupation $model
     * @return \League\Fractal\Resource\Collection
     */
    public function includeAudiences(Occupation $model)
    {
        $audiences = $model->audiences;

        return $this->collection($audiences, new AudienceTransformer);
    }

    /**
     * Audiences relation
     *
     * @param Occupation $model
     * @return \League\Fractal\Resource\Collection
     */
    public function includeTheme(Occupation $model)
    {
        $theme = $model->theme;

        return $this->item($theme, new ThemeTransformer);
    }
}
