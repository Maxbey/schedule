<?php

namespace App\Entities;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
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

    /**
     * @param Carbon $from
     * @param Carbon $to
     * @return Collection
     */
    public function getOccupationsForPeriod(Carbon $from, Carbon $to)
    {
        return $occupations = $this->occupations->filter(function(Occupation $occupation) use($from, $to){
            return Carbon::parse($occupation->date_of)->between($from, $to);
        });
    }

    public function getHoursForPeriod(Carbon $from, Carbon $to)
    {
        $sum = 0;

        $this->getOccupationsForPeriod($from, $to)->each(function(Occupation $occupation) use(&$sum){
            $sum += $occupation->theme->duration;
        });

        return $sum;
    }
}
