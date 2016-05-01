<?php

namespace App\Services;

use App\Entities\Occupation;
use App\Entities\Theme;
use App\Entities\Troop;
use App\Repositories\OccupationsRepository;
use Carbon\Carbon;
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


        dd($theme->occupations->toArray());
        return $occupation;
    }

    /**
     * Make Occupation instance
     *
     * @param Troop $troop
     * @param Theme $theme
     * @param Carbon $date
     * @param $initialHour
     * @return Occupation
     */
    public function make(Troop $troop, Theme $theme, Carbon $date, $initialHour)
    {
        $occupation = new Occupation;

        $occupation->date_of = $date->toDateTimeString();
        $occupation->initial_hour = $initialHour;

        $occupation->troop()->associate($troop)
            ->theme()->associate($theme);

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


    public function troopLearnHours(Troop $troop, Carbon $date)
    {
        $hours = 0;


        $this->repository->findByTroopAndDate($troop, $date)->each(function($occupation) use(&$hours){
            $hours += $occupation->theme->duration;
        });

        return $hours;
    }

}