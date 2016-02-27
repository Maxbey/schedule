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
     * Relations
     *
     * @var array
     */
    protected $availableIncludes = [
        'troops',
        'disciplines'
    ];

    /**
     * Transform the \Specialty entity
     * @param Specialty $model
     *
     * @return array
     */
    public function transform(Specialty $model)
    {
        return [
            'name' => $model->name,
            'code' => $model->code,
            'links' => [
                'show' => route('api.specialties.show', ['id' => $model->id]) . '?include=troops,disciplines',
                'self' => route('api.specialties.show', ['id' => $model->id]),
                'setDisciplines' => route('api.specialties.setDisciplines', ['id' => $model->id])
            ]
        ];
    }

    /**
     * Troops relation
     *
     * @param Specialty $model
     * @return \League\Fractal\Resource\Collection
     */
    public function includeTroops(Specialty $model)
    {
        $troops = $model->troops;

        return $this->collection($troops, new TroopTransformer);
    }

    /**
     * Disciplines relation
     *
     * @param Specialty $model
     * @return \League\Fractal\Resource\Collection
     */
    public function includeDisciplines(Specialty $model)
    {
        $disciplines = $model->disciplines;

        return $this->collection($disciplines, new DisciplineTransformer);
    }


}
