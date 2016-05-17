<?php

namespace App\Repositories;

use App\Entities\Teacher;
use App\Entities\Troop;
use App\Repositories\RepositoryInterface;
use Carbon\Carbon;

/**
 * Interface OccupationsRepository
 * @package namespace App\Repositories;
 */
interface OccupationsRepository extends RepositoryInterface
{
    public function findByDate($date);

    public function findByTroopAndDate(Troop $troop, Carbon $date);
}
