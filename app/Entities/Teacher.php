<?php

namespace App\Entities;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Teacher extends Model implements SluggableInterface
{
    use SluggableTrait;
    use SoftDeletes;

    protected $table = 'teachers';

    protected $fillable = [
        'name',
        'work_hours_limit',
        'military_rank'
    ];

    protected $sluggable = [
        'build_from' => 'name',
        'save_to' => 'slug'
    ];

    public function themes()
    {
        return $this->belongsToMany(Theme::class)->withTimestamps();
    }

    public function occupations()
    {
        return $this->belongsToMany(Occupation::class)->withTimestamps();
    }
}
