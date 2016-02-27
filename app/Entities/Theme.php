<?php

namespace App\Entities;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Theme extends Model
{
    use SluggableTrait;
    use SoftDeletes;

    protected $table = 'themes';

    protected $fillable = ['name', 'term'];

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }

    public function audiences()
    {
        return $this->belongsToMany(Audience::class);
    }

    public function occupations()
    {
        return $this->hasMany(Occupation::class);
    }

    /**
     * Get name of discipline through relation
     *
     * @return mixed
     */
    public function getDisciplineNameAttribute()
    {
        return $this->discipline->full_name;
    }

}
