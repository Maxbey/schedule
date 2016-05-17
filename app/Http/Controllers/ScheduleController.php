<?php

namespace App\Http\Controllers;

use App\Entities\Teacher;
use App\Excel\ScheduleExport;
use App\Repositories\OccupationsRepository;
use App\Repositories\TeachersRepository;
use App\Repositories\TroopsRepository;
use App\Schedule\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    /**
     * @var TroopsRepository
     */
    protected $troopsRepository;

    protected $teachersRepository;

    /**
     * @var Schedule
     */
    protected $schedule;

    /**
     * ScheduleController constructor.
     *
     * @param Schedule $schedule
     * @param TroopsRepository $troopsRepository
     * @param TeachersRepository $teachersRepository
     */
    public function __construct(Schedule $schedule, TroopsRepository $troopsRepository, TeachersRepository $teachersRepository)
    {
        $this->troopsRepository = $troopsRepository;
        $this->teachersRepository = $teachersRepository;

        $this->schedule = $schedule;
    }

    public function index()
    {
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

            $arr[$teacher->name] = [
                'absolute' => $sum,
                'relatively' => $sum / $teacher->work_hours_limit
            ];
        });

        return $arr;
    }
}
