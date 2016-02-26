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
    protected function repository()
    {
        return 'App\Repositories\OccupationsRepository';
    }

    public function create
    (
        Carbon $date,
        Teacher $teacher,
        Troop $troop,
        Theme $theme,
        Discipline $discipline,
        Audience $audience
    )
    {
        $occupation = new Occupation;
        $occupation->date_of = $date;

        $occupation
            ->teacher()->associate($teacher)
            ->troop()->associate($troop)
            ->theme()->associate($theme)
            ->discipline()->associate($discipline)
            ->audience()->associate($audience)
            ->save();

        return $occupation;
    }

}