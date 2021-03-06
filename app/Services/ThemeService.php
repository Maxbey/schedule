<?php

namespace App\Services;


use App\Entities\Discipline;
use App\Entities\Theme;
use App\Entities\Troop;
use App\Repositories\ThemesRepository;
use Illuminate\Database\Eloquent\Collection;

class ThemeService extends EntityService
{
    /**
     * Define repository.
     *
     * @return string
     */
    protected function repository()
    {
        return 'App\Repositories\ThemesRepository';
    }

    /**
     * Create instance of Theme
     *
     * @param Discipline $discipline
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(Discipline $discipline, array $attributes)
    {
        return $discipline->themes()->create($attributes);
    }

    /**
     * Update Theme
     *
     * @param int $id
     * @param Discipline $discipline
     * @param array $attributes
     * @return mixed
     */
    public function update($id, Discipline $discipline, array $attributes)
    {
        $theme = $this->getById($id)
            ->fill($attributes);

        $theme->discipline()
            ->associate($discipline)
            ->save();

        return $theme;
    }

    /**
     * Sync Teachers through relation
     *
     * @param Theme $theme
     * @param Collection $teachers
     * @return array
     */
    public function syncTeachers(Theme $theme, Collection $teachers)
    {
        return $theme
            ->teachers()
            ->sync($teachers);
    }

    /**
     * Sync Audiences through relation
     *
     * @param Theme $theme
     * @param Collection $audiences
     * @return array
     */
    public function syncAudiences(Theme $theme, Collection $audiences)
    {
        $theme->audiences()
            ->sync($audiences);

        return $theme;
    }

    /**
     * Sync PrevThemes through relation
     *
     * @param Theme $theme
     * @param Collection $themes
     * @return Theme
     */
    public function syncPrevThemes(Theme $theme, Collection $themes)
    {
        $theme->prevThemes()
            ->sync($themes);

        return $theme;
    }
}