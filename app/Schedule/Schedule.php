<?php

namespace App\Schedule;


use App\Entities\Audience;
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
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

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

                    $teachers = $this->findFreeTeachers($occupation);
                    $teachers->splice($theme->teachers_count);

                    $audiences = $this->findFreeAudiences($occupation);
                    $audiences->splice($theme->audiences_count);

                    $occupation->teachers = $teachers;
                    $occupation->audiences = $audiences;

                    $this->schedule->push($occupation);
                    $hours += $occupation->theme->duration;
                }
            });
        }

        $this->schedule->sortBy('date_of');
        $this->pushScheduleToDB();
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

    /**
     * @param Occupation $occupation
     * @return \Illuminate\Support\Collection
     */
    protected function findFreeTeachers(Occupation $occupation)
    {
        $inSameTime = $this->getOccupationsInSameTime($occupation);
        $freeTeachers = collect();

        $occupation->theme->teachers->each(function(Teacher $teacher) use(&$freeTeachers, $inSameTime){
            if($this->teacherIsFree($teacher, $inSameTime))
            {
                $teacher->ratio = $this->calcTeacherRatio($teacher);
                $freeTeachers->push($teacher);
            }
        });

        return $freeTeachers->sortBy('ratio');
    }

    /**
     * @param Teacher $requiredTeacher
     * @param Collection $occupations
     * @return bool
     */
    protected function teacherIsFree(Teacher $requiredTeacher, Collection $occupations)
    {
        $isFree = true;

        $occupations->each(function(Occupation $occupation) use($requiredTeacher, &$isFree){
            $occupation->teachers->each(function(Teacher $teacher) use($requiredTeacher, &$isFree){
                if($teacher->id === $requiredTeacher->id)
                    $isFree = false;
            });
        });

        return $isFree;
    }

    /**
     * @param Occupation $occupation
     * @return Collection
     */
    protected function findFreeAudiences(Occupation $occupation)
    {
        $inSameTime = $this->getOccupationsInSameTime($occupation);
        $freeAudiences = collect();

        $occupation->theme->audiences->each(function(Audience $audience) use(&$freeAudiences, $inSameTime){
            if($this->audienceIsFree($audience, $inSameTime))
            {
                $freeAudiences->push($audience);
            }
        });

        return $freeAudiences;
    }

    protected function audienceIsFree(Audience $requiredAudience, Collection $occupations)
    {
        $isFree = true;

        $occupations->each(function(Occupation $occupation) use($requiredAudience, &$isFree){
            $occupation->audiences->each(function(Audience $audience) use($requiredAudience, &$isFree){
                if($audience->id === $requiredAudience->id)
                    $isFree = false;
            });
        });

        return $isFree;
    }

    protected function calcTeacherRatio(Teacher $teacher)
    {
        $hours = 0;

        $this->schedule->each(function(Occupation $occupation) use(&$hours, $teacher){
            if($occupation->teachers->contains('id', $teacher->id))
            {
                $hours += $occupation->theme->duration;
            }
        });

        return $hours / $teacher->work_hours_limit;
    }


    protected function pushScheduleToDB()
    {
        $this->schedule->each(function(Occupation $occupation){
            $teachers = new EloquentCollection($occupation->teachers);
            $audiences = new EloquentCollection($occupation->audiences);

            unset($occupation->teachers);
            unset($occupation->audiences);

            $occupation->save();
            $occupation->teachers()->sync($teachers);
            $occupation->audiences()->sync($audiences);
        });

    }

    /**
     * @param Occupation $occupation
     * @return \Illuminate\Support\Collection
     */
    protected function getOccupationTimeLine(Occupation $occupation)
    {
        $timeLine = collect();
        $endHour = $occupation->initial_hour + $occupation->theme->duration;

        for($i = $occupation->initial_hour + 1; $i < $endHour; $i++)
        {
            $timeLine->push($i);
        }

        return $timeLine;
    }

    /**
     * @param Occupation $mainOccupation
     * @return \Illuminate\Support\Collection
     */
    protected function getOccupationsInSameTime(Occupation $mainOccupation)
    {
        $timeLine = $this->getOccupationTimeLine($mainOccupation);
        $inSameTime = collect();

        $this->schedule->where('date_of', $mainOccupation->date_of)
            ->each(function(Occupation $occupation) use($timeLine, &$inSameTime, $mainOccupation){
                if(
                    $this->getOccupationTimeLine($occupation)->intersect($timeLine)->count()
                    && $occupation->troop->id !== $mainOccupation->troop->id
                )
                    $inSameTime->push($occupation);
        });

        return $inSameTime;
    }

}