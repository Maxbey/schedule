<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Occupation extends Model
{
    use SoftDeletes;

    protected $table = 'occupations';

    protected $fillable = ['date_of'];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class)->withTimestamps();
    }

    public function troop()
    {
        return $this->belongsTo(Troop::class);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    public function audiences()
    {
        return $this->belongsToMany(Audience::class)->withTimestamps();
    }

    public function getThemeNameAttribute()
    {
        return $this->theme->name;
    }

    public function getTroopCodeAttribute()
    {
        return $this->troop->code;
    }

}
