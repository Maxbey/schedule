<?php

namespace App\Entities;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Teacher extends Model implements Transformable, SluggableInterface
{
    use TransformableTrait;
    use SluggableTrait;
    use SoftDeletes;

    protected $table = 'teachers';

    protected $fillable = [
        'firstname',
        'lastname',
        'middlename',
        'work_hours_limit'
    ];

    protected $sluggable = [
        'build_from' => 'lastname',
        'save_to' => 'slug'
    ];

    public function themes()
    {
        return $this->belongsToMany(Theme::class);
    }

    public function occupations()
    {
        return $this->hasMany(Occupation::class);
    }

}
