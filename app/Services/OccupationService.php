<?php

namespace App\Services;


use App\Entities\Discipline;
use App\Entities\Occupation;
use App\Entities\Teacher;
use App\Entities\Theme;
use App\Entities\Troop;
use App\Repositories\OccupationsRepository;

class OccupationService extends EntityService
{
    protected function repository()
    {
        return 'App\Repositories\OccupationsRepository';
    }

    public function create
    (
        $date,
        Teacher $teacher,
        Troop $troop,
        Theme $theme,
        Discipline $discipline
    )
    {
        $occupation = new Occupation;

        $occupation
            ->teacher()
            ->associate($teacher)
            ->troop()
            ->associate($troop)
            ->theme()
            ->associate($theme)
            ->discipline()
            ->associate($discipline)
            ->save();

        return $occupation;
    }

}