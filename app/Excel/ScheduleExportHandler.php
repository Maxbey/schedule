<?php

namespace App\Excel;


use App\Entities\Audience;
use App\Entities\Occupation;
use App\Entities\Teacher;
use App\Repositories\OccupationsRepository;
use Carbon\Carbon;
use Maatwebsite\Excel\Files\ExportHandler;

class ScheduleExportHandler
{
    /**
     * @var OccupationsRepository
     */
    protected $occupationsRepository;

    protected $cellsForOccupations = ['C', 'D', 'E'];

    public function __construct(OccupationsRepository $occupationsRepository)
    {
        $this->occupationsRepository = $occupationsRepository;
    }

    /**
     * @param ScheduleExport $export
     */
    public function handle(ScheduleExport $export)
    {
        $schedule = $this->occupationsRepository->with(['teachers', 'audiences', 'theme', 'troop'])->all()->sortBy('date_of')->groupBy('date_of');

        return $export->sheet('Schedule', function($sheet) use($schedule){

            $sheet->row(1, [
                'Дата', 'Взвод',
                '9:00 - 10:35',
                '10:45 - 12:20',
                '13:00 - 14:35'
            ]);

            $row = 2;
            $schedule->each(function($day) use(&$sheet, &$row){
                $sheet->cell('A' . $row, function($cell) use($day){
                    $cell->setValue(Carbon::parse($day->first()->date_of)->format('m-d'));
                });

                $day->sortBy('troop_code')->sortBy('initial_hour')->groupBy('troop_id')->each(function($troopOccupations) use(&$sheet, &$row){
                    $troopCode = $troopOccupations->first()->troop->code;

                    $sheet->cell('B' . $row, function($cell) use ($troopCode){
                        $cell->setValue($troopCode);
                    });

                    for($i = 0; $i < count($this->cellsForOccupations);)
                    {
                        $cellChar = $this->cellsForOccupations[$i];
                        $occupation = $troopOccupations->shift();

                        if($occupation !== NULL)
                        {
                            if($occupation->theme->duration > 2)
                            {
                                $sheet->mergeCells($cellChar . $row . ':' . $this->cellsForOccupations[intval($occupation->theme->duration / 2) - (1 - $i)] . $row);
                                $i += $occupation->theme->duration / 2;
                            }
                            else
                            {
                                $i++;
                            }

                            $sheet->cell($cellChar . $row, function($cell) use($occupation){
                                $cell->setValue(
                                    $occupation->theme->discipline->short_name . ' №' . $occupation->theme->number
                                    . ' кл. ' . $this->formAudiencesString($occupation)
                                    . ' ' . $this->formTeachersString($occupation)
                                );
                            });

                        }
                        else
                            break;
                    }

                    $row++;
                });

                $row++;
            });

        })->download('xls');
    }

    protected function formAudiencesString(Occupation $occupation)
    {
        $string = '';

        $occupation->audiences->each(function(Audience $audience) use (&$string){
            $string .= $audience->location . '  ';
        });

        return $string;
    }

    protected function formTeachersString(Occupation $occupation)
    {
        $string = '';

        $occupation->teachers->each(function(Teacher $teacher) use(&$string){
            $string .= $teacher->name;
        });

        return $string;
    }
}