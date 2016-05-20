<?php

namespace App\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Term extends Model
{

    protected $fillable = ['start', 'end'];

    public function setStartAttribute($start)
    {
        $this->attributes['start'] = Carbon::parse($start);
    }

    public function setEndAttribute($end)
    {
        $this->attributes['end'] = Carbon::parse($end);
    }

}
