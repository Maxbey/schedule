<?php

namespace App\Entities;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialty extends Model implements SluggableInterface
{
    use SluggableTrait;
    use SoftDeletes;

    protected $table = 'specialties';

    protected $fillable = ['code'];

    protected $sluggable = [
        'build_from' => 'code',
        'save_to' => 'slug'
    ];

    public function troops()
    {
        return $this->hasMany(Troop::class);
    }


    public function disciplines()
    {
        return $this->belongsToMany(Discipline::class)->withTimestamps();
    }

    /**
     * Handle Eloquent events.
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function(Specialty $specialty){
            $specialty->troops()->delete();
        });
    }

}
