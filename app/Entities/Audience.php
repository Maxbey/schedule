<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Audience extends Model
{
    use SoftDeletes;

    protected $table = 'audiences';

    protected $fillable = [
        'name',
        'building',
        'number'
    ];

    public function themes()
    {
        return $this->belongsToMany(Theme::class)->withTimestamps();
    }

    public function occupations()
    {
        return $this->hasMany(Occupation::class);
    }

    public function getLocationAttribute()
    {
        return $this->building . '-' . $this->number;
    }

}
