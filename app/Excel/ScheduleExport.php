<?php

namespace App\Excel;


use Maatwebsite\Excel\Files\NewExcelFile;

class ScheduleExport extends NewExcelFile
{

    /**
     * Get file
     * @return string
     */
    public function getFilename()
    {
        return 'Schedule';
    }
}