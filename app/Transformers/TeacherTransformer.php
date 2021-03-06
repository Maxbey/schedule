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
     * Relations
     *
     * @var array
     */
    protected $availableIncludes = [
        'themes'
    ];

    /**
     * Transform the \Teacher entity
     * @param Teacher $model
     *
     * @return array
     */
    public function transform(Teacher $model)
    {
        return [
            'id'   => $model->id,
            'name' => $model->name,
            'military_rank' => $model->military_rank,
            'work_hours_limit' => $model->work_hours_limit,
            'links' => [
                'self' => route('api.teachers.show', ['id' => $model->id])
            ]
        ];
    }

    /**
     * Themes relation
     *
     * @param Teacher $model
     * @return \League\Fractal\Resource\Collection
     */
    public function includeThemes(Teacher $model)
    {
        $themes = $model->themes;

        return $this->collection($themes, new ThemeTransformer);
    }
}
