<?php

namespace App\Http\Controllers;

use App\Entities\Occupation;
use App\Entities\Teacher;
use App\Excel\ScheduleExport;
use App\Excel\ScheduleExportHandler;
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

    /**
     * @var TermsRepository
     */
    protected $termsRepository;

    /**
     * @var ScheduleExportHandler
     */
    protected $exportHandler;

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
     * @param TermsRepository $termsRepository
     * @param ScheduleExportHandler $scheduleExportHandler
     */
    public function __construct
    (
        Schedule $schedule,
        TroopsRepository $troopsRepository,
        TeachersRepository $teachersRepository,
        TermsRepository $termsRepository,
        ScheduleExportHandler $scheduleExportHandler
    )
    {
        $this->troopsRepository = $troopsRepository;
        $this->teachersRepository = $teachersRepository;
        $this->termsRepository = $termsRepository;

        $this->termsRepository->setPresenter('App\Presenters\TermPresenter');
        $this->exportHandler = $scheduleExportHandler;

        $this->schedule = $schedule;
    }

    public function createSchedule(Request $request)
    {
        DB::statement('SET foreign_key_checks=0');
        Occupation::truncate();
        DB::statement('SET foreign_key_checks=1');

        $troops = $this->troopsRepository->all();
        $startDate = Carbon::parse('2016-02-01');

        $this->schedule->buildSchedule($troops, $startDate, 20);
    }

    public function export(Request $request)
    {
        $troops = $this->troopsRepository
            ->findByIds(explode('|', $request->input('troops')));

        $this->exportHandler->handle($troops);
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
