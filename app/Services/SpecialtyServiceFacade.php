<?php

namespace App\Services;


use Illuminate\Support\Facades\Facade;

class SpecialtyServiceFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'SpecialtyService'; }
}