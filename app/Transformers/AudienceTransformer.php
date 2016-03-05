<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Audience;

/**
 * Class AudienceTransformer
 * @package namespace App\Transformers;
 */
class AudienceTransformer extends TransformerAbstract
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
     * Transform the \Audience entity
     * @param Audience $model
     *
     * @return array
     */
    public function transform(Audience $model)
    {
        return [
            'name' => $model->name,
            'location' => $model->location,
            'links' => [
                'self' => route('api.audiences.show', ['id' => $model->id]),
                'setThemes' => route('api.audiences.setThemes', ['id' => $model->id])
            ]
        ];
    }

    /**
     * Themes relation
     *
     * @param Audience $model
     * @return \League\Fractal\Resource\Collection
     */
    public function includeThemes(Audience $model)
    {
        $themes = $model->themes;

        return $this->collection($themes, new ThemeTransformer);
    }
}
