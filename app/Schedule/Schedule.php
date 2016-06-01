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
use App\Repositories\TroopsRepository;
use App\Services\OccupationService;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class Schedule extends AbstractSchedule

{
    /*
     * The number of academic hours for lessons
     * @var int
     */
    private $lessonsHours = 6;

    /**
     * @var OccupationService
     */
    private $occupationService;

    /**
     * @var DisciplinesRepository
     */
    private $disciplinesRepository;

    /**
     * @var Collection
     */
    private $schedule;


    /**
     * Schedule constructor.
     *
     * @param TroopsRepository $troopsRepository
     * @param OccupationService $occupationService
     * @param DisciplinesRepository $disciplinesRepository
     * @param OccupationsRepository $occupationsRepository
     */
    public function __construct
    (
        OccupationService $occupationService,
        DisciplinesRepository $disciplinesRepository, OccupationsRepository $occupationsRepository
    )
    {
        $this->occupationService = $occupationService;
        $this->disciplinesRepository = $disciplinesRepository;


        $this->schedule = $occupationsRepository->all();
    }

    /**
     * @param Collection $troops
     * @param Carbon $date
     * @param $termLength
     * @param $term
     */
    public function buildSchedule(Collection $troops,Carbon $date, $termLength)
    {
        for($i = 0; $i < $termLength; $i++, $date->addWeek())
        {
            $troops->each(function(Troop $troop) use($date){
                $date->startOfWeek();
                $date->addDays($troop->day);
                $hours = 0;

                while($hours != $this->lessonsHours) {
                    $disciplines = $this->getPriorityDisciplinesList($troop);

                    $theme = null;
                    $teachers = null;
                    $audiences = null;

                    while(1)
                    {

                        if(!$disciplines->count())
                            break 2;

                        if($disciplines->first()->ratio == 1)
                            break 2;

                        $theme = $this->getNextTheme($disciplines->first(), $troop);

                        if(!$theme)
                        {
                            $disciplines->shift();
                            continue;
                        }

                        if(($hours + $theme->duration) > $this->lessonsHours)
                        {
                            $disciplines->shift();
                            continue;
                        }

                        if(!$this->checkPrevThemes($theme, $troop))
                        {
                            $disciplines->shift();
                            continue;
                        }

                        if($this->getOccupationsInSameTime($theme, $hours, $date, $troop)->contains('theme_id', $theme->id))
                        {
                            $disciplines->shift();
                            continue;
                        }

                        $inSameTime = $this->getOccupationsInSameTime($theme, $hours, $date, $troop);

                        $teachers = $this->findFreeTeachers($theme, $inSameTime);
                        $teachers->splice($theme->teachers_count);

                        $audiences = $this->findFreeAudiences($theme, $inSameTime);
                        $audiences->splice($theme->audiences_count);

                        if($teachers->count() < $theme->teachers_count || $audiences->count() < $theme->audiences_count)
                            $disciplines->shift();

                        else
                            break;
                    }



                    if($theme === null)
                        break;

                    $occupation = $this->createOccupation($troop, $theme, $date, $hours);
                    $occupation->teachers = $teachers;
                    $occupation->audiences = $audiences;

                    $this->schedule->push($occupation);
                    $hours += $occupation->theme->duration;
                }
            });
        }
        
        $this->pushScheduleToDB();
    }

    protected function getNextTheme(Discipline $discipline, Troop $troop)
    {
        return $discipline
            ->themes
            ->where('term', $troop->term)
            ->sortBy('number')
            ->first(function ($key, Theme $theme) use ($troop) {
                return !$this->schedule->where('theme_id', $theme->id)->contains('troop_id', $troop->id);
            });
    }

    protected function checkPrevThemes(Theme $theme, Troop $troop)
    {
        $result = true;
        $allOccupations = $this->schedule->where('troop_id', $troop->id);

        $prevThemes = $theme->prevThemes;

        if(!$prevThemes->count())
            return true;

        $prevThemes->each(function(Theme $prevTheme) use($allOccupations, &$result){
            if(!$allOccupations->contains('theme_id', $prevTheme->id))
                $result = false;
        });

        return $result;
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
     * @param $term
     * @return mixed
     */
    protected function getPriorityDisciplinesList(Troop $troop)
    {
        $disciplines = $troop
            ->specialty
            ->disciplines->each(function(Discipline &$discipline) use($troop){
                $totalHours = $discipline->hoursSum;
                $currentHours = 0;

                $discipline->themes
                    ->where('term', $troop->term)
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
     * @param Theme $theme
     * @param Collection $inSameTime
     * @return Collection
     */
    protected function findFreeTeachers(Theme $theme, Collection $inSameTime)
    {
        $freeTeachers = collect();

        $theme->teachers->each(function(Teacher $teacher) use(&$freeTeachers, $inSameTime){
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
     * @param Theme $theme
     * @param Collection $inSameTime
     * @return Collection
     */
    protected function findFreeAudiences(Theme $theme, Collection $inSameTime)
    {
        $freeAudiences = collect();

        $theme->audiences->each(function(Audience $audience) use(&$freeAudiences, $inSameTime){
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
        $this->schedule->sortBy('date_of')->each(function(Occupation $occupation){
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
        $endHour = $occupation->initial_hour + $occupation->theme->duration;

        return $this->getNumbersBetween($occupation->initial_hour, $endHour);
    }

    /**
     * @param Theme $theme
     * @param $initialHour
     * @param Carbon $date
     * @param Troop $troop
     * @return Collection
     */
    protected function getOccupationsInSameTime(Theme $theme, $initialHour, Carbon $date, Troop $troop)
    {
        $timeLine = $this->getNumbersBetween($initialHour, $initialHour + $theme->duration);
        $inSameTime = collect();

        $this->schedule->where('date_of', $date->toDateTimeString())
            ->each(function(Occupation $occupation) use($timeLine, &$inSameTime, $troop){
                if(
                    $this->getOccupationTimeLine($occupation)->intersect($timeLine)->count()
                    && $occupation->troop->id !== $troop->id
                )
                    $inSameTime->push($occupation);
        });

        return $inSameTime;
    }


    protected function getNumbersBetween($a, $b)
    {
        $numbers = collect();

        for($i = $a + 1; $i < $b; $i++)
        {
            $numbers->push($i);
        }

        return $numbers;
    }

}
