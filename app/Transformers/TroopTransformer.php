<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Troop;

/**
 * Class TroopTransformer
 * @package namespace App\Transformers;
 */
class TroopTransformer extends TransformerAbstract
{

    /**
     * Relations
     *
     * @var array
     */
    protected $availableIncludes = [
        'specialty'
    ];

    /**
     * Transform the \Troop entity
     * @param Troop $model
     *
     * @return array
     */
    public function transform(Troop $model)
    {
        return [
            'id' => $model->id,
            'code' => $model->code,
            'day' => (int) $model->day,
            'specialty' => $model->specialtyCode,
            'specialty_id' => $model->specialty->id,
            'links' => [
                'show' => route('api.troops.show', ['id' => $model->id]),
                'self' => route('api.troops.show', ['id' => $model->id])
            ]
        ];
    }

    /**
     * Specialty relation
     *
     * @param Troop $model
     * @return \League\Fractal\Resource\Item
     */
    public function includeSpecialty(Troop $model)
    {
        return $this->item($model->specialty, new SpecialtyTransformer);
    }
}
