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
     * Transform the \Audience entity
     * @param Audience $model
     *
     * @return array
     */
    public function transform(Audience $model)
    {
        return [
            'name' => $model->name,
            'location' => $model->location
        ];
    }
}
