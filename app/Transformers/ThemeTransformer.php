<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Theme;

/**
 * Class ThemeTransformer
 * @package namespace App\Transformers;
 */
class ThemeTransformer extends TransformerAbstract
{

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
            'discipline' => $model->disciplineName
        ];
    }
}
