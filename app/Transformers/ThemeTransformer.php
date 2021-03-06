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
        'audiences',
        'prevThemes'
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
            'id'   => $model->id,
            'name' => $model->name,
            'number' => $model->number,
            'discipline' => $model->disciplineName,
            'term' => $model->term,
            'self_study' => $model->self_study,
            'audiences_count' => $model->audiences_count,
            'teachers_count'  => $model->teachers_count,
            'duration'      => $model->duration,
            'links' => [
                'self' => route('api.themes.show', ['id' => $model->id])
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

    /**
     * PrevThemes relation
     *
     * @param Theme $model
     * @return \League\Fractal\Resource\Collection
     */
    public function includePrevThemes(Theme $model)
    {
        $themes = $model->prevThemes;

        return $this->collection($themes, new ThemeTransformer);
    }
}
