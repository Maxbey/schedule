<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Specialty;

/**
 * Class SpecialtyTransformer
 * @package namespace App\Transformers;
 */
class SpecialtyTransformer extends TransformerAbstract
{
    /**
     * Transform the \Specialty entity
     * @param Specialty $model
     *
     * @return array
     */
    public function transform(Specialty $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'code' => $model->code,
            'links' => [
                'show' => route('api.specialties.show', ['id' => $model->id]) . '?include=troops,disciplines',
                'delete' => route('api.specialties.destroy', ['id' => $model->id])
            ]
        ];
    }

    protected $availableIncludes = [
        'troops',
        'disciplines'
    ];

    public function includeTroops(Specialty $model)
    {
        $troops = $model->troops;

        return $this->collection($troops, new TroopTransformer);
    }

    public function includeDisciplines(Specialty $model)
    {
        $disciplines = $model->disciplines;

        return $this->collection($disciplines, new DisciplineTransformer);
    }


}
