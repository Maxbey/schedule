<?php

namespace App\Http\Controllers;

use App\Excel\ScheduleExport;
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

    /**
     * @var Schedule
     */
    protected $schedule;

    /**
     * ScheduleController constructor.
     * @param Schedule $schedule
     * @param TroopsRepository $troopsRepository
     */
    public function __construct(Schedule $schedule, TroopsRepository $troopsRepository)
    {
        $this->troopsRepository = $troopsRepository;

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
}
