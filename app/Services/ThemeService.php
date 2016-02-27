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

    public function update($id, Discipline $discipline, array $attributes)
    {
        $theme = $this->getById($id)
            ->fill($attributes);

        $theme->discipline()
            ->associate($discipline)
            ->save();

        return $theme;
    }

    public function syncTeachers($themeId, Collection $teachers)
    {
        return $this->getById($themeId)
            ->teachers()
            ->sync($teachers);
    }

    public function syncAudiences($themeId, Collection $audiences)
    {
        return $this->getById($themeId)
            ->audiences()
            ->sync($audiences);
    }
}