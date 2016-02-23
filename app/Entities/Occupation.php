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

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function troop()
    {
        return $this->belongsTo(Troop::class);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }

    public function audience()
    {
        return $this->belongsTo(Audience::class);
    }

}
