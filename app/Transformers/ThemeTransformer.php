<?php

namespace App\Transformers;

use App\Entities\Teacher;
use League\Fractal\TransformerAbstract;
use App\Entities\Theme;

/**
 * Class ThemeTransformer
 * @package namespace App\Transformers;
 */
class ThemeTransformer extends TransformerAbstract
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
     * Transform the \Theme entity
     * @param Theme $model
     *
     * @return array
     */
    public function transform(Theme $model)
    {
        return [
            'name' => $model->name,
            'discipline' => $model->disciplineName,
            'links' => [
                'self' => route('api.themes.show', ['id' => $model->id]),
                'setAudiences' => route('api.themes.setAudiences', ['id' => $model->id]),
                'setTeachers'  => route('api.themes.setTeachers', ['id' => $model->id])
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
