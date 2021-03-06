<?php

namespace App\Entities;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Discipline extends Model implements SluggableInterface
{
    use SluggableTrait;
    use SoftDeletes;

    protected $table = 'disciplines';

    protected $fillable = ['full_name', 'short_name'];

    protected $sluggable = [
        'build_from' => 'short_name',
        'save_to' => 'slug'
    ];

    public function themes()
    {
        return $this->hasMany(Theme::class);
    }

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class)->withTimestamps();
    }

    public function getHoursSumAttribute()
    {
        return $this->themes->sum('duration');
    }

    /**
     * Handle Eloquent events.
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function(Discipline $discipline){
            $discipline->themes()->delete();
        });

    }


}
