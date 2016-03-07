<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Troop extends Model
{
    use SoftDeletes;

    protected $table = 'troops';

    protected $fillable = ['code', 'day'];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function occupations()
    {
        return $this->hasMany(Occupation::class);
    }

    /**
     * Get name of Specialty through relation
     *
     * @return mixed
     */
    public function getSpecialtyCodeAttribute()
    {
        return $this->specialty->code;
    }

}
