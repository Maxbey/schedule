<?php

namespace App\Schedule;


use App\Entities\Discipline;
use App\Entities\Occupation;
use App\Entities\Teacher;
use App\Entities\Theme;
use App\Entities\Troop;
use App\Repositories\DisciplinesRepository;
use App\Repositories\OccupationsRepository;
use App\Repositories\TeachersRepository;
use App\Repositories\TroopsRepository;
use App\Services\OccupationService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class Schedule extends AbstractSchedule

{
    /*
     * The number of academic hours per day.
     * @var int
     */
    private $dayLength = 6;

    /**
     * The term length in weeks
     * @var int
     */
    private $termLength = 2;

    /**
     * @var TroopsRepository
     */
    private $troopsRepository;

    /**
     * @var OccupationService
     */
    private $occupationService;


    /**
     * @var DisciplinesRepository
     */
    private $disciplinesRepository;

    private $teachersRepository;

    /**
     * @var Collection
     */
    private $schedule;


    /**
     * Schedule constructor.
     * @param TroopsRepository $troopsRepository
     * @param OccupationService $occupationService
     * @param DisciplinesRepository $disciplinesRepository
     * @param OccupationsRepository $occupationsRepository
     * @param TeachersRepository $teachersRepository
     */
    public function __construct
    (
        TroopsRepository $troopsRepository, OccupationService $occupationService,
        DisciplinesRepository $disciplinesRepository, OccupationsRepository $occupationsRepository,
        TeachersRepository $teachersRepository
    )
    {
        $this->troopsRepository = $troopsRepository;
        $this->occupationService = $occupationService;
        $this->disciplinesRepository = $disciplinesRepository;
        $this->teachersRepository = $teachersRepository;


        $this->schedule = $occupationsRepository->all();
    }


    public function buildSchedule()
    {

        $date = Carbon::parse('2016-02-01');

        for($i = 0; $i < $this->termLength; $i++, $date->addWeek())
        {
            $this->troopsRepository->all()->each(function(Troop $troop) use($date){
                $date->startOfWeek();
                $date->addDays($troop->day - 1);
                $hours = 0;

                while($hours != $this->dayLength) {

                    $disciplines = $this->getPriorityDisciplinesList($troop);
                    $theme = null;

                    while(1)
                    {
                        $discipline = $disciplines->first();
                        if($discipline->ratio == 1)
                            break 2;

                        $theme = $discipline->themes
                            ->sortBy('number')
                            ->first(function ($key, Theme $theme) use ($troop, $date) {
                                return !$this->schedule->where('theme_id', $theme->id)->contains('troop_id', $troop->id);
                            });

                        if(($hours + $theme->duration) > 6)
                        {
                            $disciplines->shift();
                        }

                        else if($disciplines->count() === 0)
                        {
                            break 2;
                        }

                        else
                        {
                            break;
                        }

                    }



                    if($theme === null)
                        break;

                    $occupation = $this->createOccupation($troop, $theme, $date, $hours);

                    $this->schedule->push($occupation);
                    $this->pushScheduleToDB();
                    $hours += $occupation->theme->duration;
                }
            });
        }

        $this->pushScheduleToDB();
        dd("Done");

    }

    /**
     * @param Troop $troop
     * @param Theme $theme
     * @param Carbon $date
     * @param $initialHour
     * @return Occupation
     */
    protected function createOccupation(Troop $troop, Theme $theme, Carbon $date, $initialHour)
    {
        return $this->occupationService->make($troop, $theme, $date, $initialHour);
    }

    /**
     * @param Troop $troop
     * @return Collection
     */
    protected function getPriorityDisciplinesList(Troop $troop)
    {
        $disciplines = $troop->specialty
            ->disciplines->each(function(Discipline $discipline) use($troop){
                $totalHours = $discipline->hoursSum;
                $currentHours = 0;

                $discipline->themes
                    ->each(function(Theme $theme) use(&$currentHours, $troop){
                        if($this->schedule->where('theme_id', $theme->id)->contains('troop_id', $troop->id))
                        {
                            $currentHours += $theme->duration;
                        }
                    });

                $discipline->ratio = $currentHours / $totalHours;
            });

        return $disciplines->sortBy('ratio');
    }

    protected function findFreeTeachers($count)
    {
        return $this->teachersRepository->all();
    }


    protected function pushScheduleToDB()
    {
        $this->schedule->each(function(Occupation $occupation){
            $occupation->save();
        });

    }

}