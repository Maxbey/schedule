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

    protected $fillable = [
        'name',
        'number',
        'term',
        'audiences_count',
        'teachers_count',
        'duration',
        'self_study'
    ];

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class)->withTimestamps();
    }

    public function audiences()
    {
        return $this->belongsToMany(Audience::class)->withTimestamps();
    }

    public function occupations()
    {
        return $this->hasMany(Occupation::class);
    }

    public function prevThemes()
    {
        return $this->belongsToMany(Theme::class, 'theme_prev_theme', 'prev_theme_id')->withTimestamps();
    }

    /**
     * Get name of discipline through relation
     *
     * @return mixed
     */
    public function getDisciplineNameAttribute()
    {
        return $this->discipline->short_name;
    }

    /**
     * Handle Eloquent events.
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function(Theme $theme){
            $theme->occupations()->delete();
        });

    }

}
