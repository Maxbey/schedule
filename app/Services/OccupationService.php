<?php

namespace App\Services;


use App\Entities\Discipline;
use App\Entities\Occupation;
use App\Entities\Teacher;
use App\Entities\Theme;
use App\Entities\Troop;
use App\Repositories\OccupationsRepository;

class OccupationService
{
    protected $occupationsRepository;

    public function __construct(OccupationsRepository $occupationsRepository)
    {
        $this->occupationsRepository = $occupationsRepository;
    }

    public function getById($id)
    {
        return $this->occupationsRepository->find($id);
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

    public function delete($id)
    {
        $this->occupationsRepository->delete($id);
    }

    public function restore($id)
    {
        $this->occupationsRepository->restore($id);
    }

}