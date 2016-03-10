<?php

namespace App\Services;

use App\Entities\Occupation;
use App\Entities\Theme;
use App\Entities\Troop;
use App\Repositories\OccupationsRepository;
use Illuminate\Database\Eloquent\Collection;

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
     * Create Occupation instance
     *
     * @param Troop $troop
     * @param Theme $theme
     * @param array $attributes
     * @return Occupation
     */
    public function create(Troop $troop, Theme $theme, array $attributes)
    {
        $occupation = new Occupation;

        $occupation->fill($attributes)
            ->troop()->associate($troop)
            ->theme()->associate($theme)
            ->save();

        return $occupation;
    }

    /**
     * Update Occupation
     *
     * @param $id
     * @param Troop $troop
     * @param Theme $theme
     * @param array $attributes
     * @return Occupation
     */
    public function update($id, Troop $troop, Theme $theme, array $attributes)
    {
        $occupation = $this->repository->find($id);

        $occupation->fill($attributes)
            ->troop()->associate($troop)
            ->theme()->associate($theme)
            ->save();

        return $occupation;
    }

    /**
     * Sync Teachers through relation
     *
     * @param Occupation $occupation
     * @param Collection $teachers
     * @return array
     */
    public function syncTeachers(Occupation $occupation, Collection $teachers)
    {
        return $occupation
            ->teachers()
            ->sync($teachers);
    }

    /**
     * Sync Audiences through relation
     *
     * @param Occupation $occupation
     * @param Collection $audiences
     * @return array
     */
    public function syncAudiences(Occupation $occupation, Collection $audiences)
    {
        return $occupation
            ->audiences()
            ->sync($audiences);
    }

}