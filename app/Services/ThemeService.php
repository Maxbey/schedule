<?php

namespace App\Services;


use App\Entities\Discipline;
use App\Repositories\ThemesRepository;
use Illuminate\Database\Eloquent\Collection;

class ThemeService extends EntityService
{
    protected function repository()
    {
        return 'App\Repositories\ThemesRepository';
    }

    public function create(Discipline $discipline, array $attributes)
    {
        return $discipline->themes()->create($attributes);
    }

    public function attachTeachers($themeId, Collection $teachers)
    {
        return $this->getById($themeId)
            ->teachers()
            ->sync($teachers);
    }

    public function attachAudiences($audienceId, Collection $audiences)
    {
        return $this->getById($audienceId)
            ->audiences()
            ->sync($audiences);
    }
}