<?php

namespace App\Http\Controllers;

use App\Excel\ScheduleExport;
use App\Schedule\Schedule;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    /**
     * @var Schedule
     */
    protected $schedule;

    /**
     * ScheduleController constructor.
     * @param Schedule $schedule
     */
    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    public function index()
    {
        $this->schedule->buildSchedule();
    }

    public function export(ScheduleExport $export)
    {
        $export->handleExport();
    }
}
