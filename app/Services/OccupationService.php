<?php

namespace App\Services;


use App\Entities\Audience;
use App\Entities\Discipline;
use App\Entities\Occupation;
use App\Entities\Teacher;
use App\Entities\Theme;
use App\Entities\Troop;
use App\Repositories\OccupationsRepository;
use Carbon\Carbon;

class OccupationService extends EntityService
{
    /**
     * Define the repository.
     *
     * @return string
     */
    protected function repository()
    {
        return 'App\Repositories\OccupationsRepository';
    }

    /**
     * Ugly stupid method for save occupation.
     * TODO: Needed refactoring!
     *
     * @param Occupation|null $occupation
     * @param array $attributes
     * @return Occupation
     */
    protected function save(Occupation $occupation = null, array $attributes)
    {
        if(!$occupation)
            $occupation = new Occupation;

        $occupation->date_of = Carbon::parse($attributes['date_of']);

        $occupation
            ->troop()->associate(Troop::findOrFail($attributes['troop_id']))
            ->theme()->associate(Theme::findOrFail($attributes['theme_id']))
            ->save();

        return $occupation;
    }

    /**
     * Save Occupation
     *
     * @param array $attributes
     * @return Occupation
     */
    public function create(array $attributes)
    {
        return $this->save(null, $attributes);
    }

    /**
     * Update Occupation
     *
     * @param $id
     * @param array $attributes
     * @return Occupation
     */
    public function update($id, array $attributes)
    {
        $occupation = $this->repository->find($id);

        return $this->save($occupation, $attributes);
    }

}