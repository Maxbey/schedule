<?php

namespace App\Http\Controllers;

use App\Entities\Teacher;
use App\Excel\ScheduleExport;
use App\Repositories\OccupationsRepository;
use App\Repositories\TeachersRepository;
use App\Repositories\TermsRepository;
use App\Repositories\TroopsRepository;
use App\Schedule\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    /**
     * @var TroopsRepository
     */
    protected $troopsRepository;

    /**
     * @var TeachersRepository
     */
    protected $teachersRepository;

    protected $termsRepository;

    /**
     * @var Schedule
     */
    protected $schedule;

    /**
     * ScheduleController constructor.
     * @param Schedule $schedule
     * @param TroopsRepository $troopsRepository
     * @param TeachersRepository $teachersRepository
     * @param TermsRepository $termsRepository
     */
    public function __construct
    (
        Schedule $schedule,
        TroopsRepository $troopsRepository,
        TeachersRepository $teachersRepository,
        TermsRepository $termsRepository
    )
    {
        $this->troopsRepository = $troopsRepository;
        $this->teachersRepository = $teachersRepository;
        $this->termsRepository = $termsRepository;

        $this->termsRepository->setPresenter('App\Presenters\TermPresenter');

        $this->schedule = $schedule;
    }

    public function createSchedule(Request $request)
    {
        $this->termsRepository->create($request->all());

        $troops = $this->troopsRepository->all();
        $startDate = Carbon::parse('2016-02-01');

        $this->schedule->buildSchedule($troops, $startDate, 20, 4);
    }

    public function export(ScheduleExport $export)
    {
        $export->handleExport();
    }

    public function teachersLoadStatistics(Request $request)
    {
        $from = Carbon::parse($request->input('from'));
        $to = Carbon::parse($request->input('to'));

        $arr = [];

        $this->teachersRepository->all()->each(function(Teacher $teacher) use (&$arr, $from, $to){
            $sum = $teacher->getHoursForPeriod($from, $to);

            $arr[] = [
                'name' => $teacher->name,
                'absolute' => $sum,
                'relatively' => round($sum / $teacher->work_hours_limit, 3)
            ];
        });

        return ['data' => $arr];
    }
}
