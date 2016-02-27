<?php

namespace App\Services;


use App\Entities\Discipline;
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
     * @param int $themeId
     * @param Collection $teachers
     * @return mixed
     */
    public function syncTeachers($themeId, Collection $teachers)
    {
        return $this->getById($themeId)
            ->teachers()
            ->sync($teachers);
    }

    /**
     * Sync Audiences through relation
     *
     * @param int $themeId
     * @param Collection $audiences
     * @return mixed
     */
    public function syncAudiences($themeId, Collection $audiences)
    {
        return $this->getById($themeId)
            ->audiences()
            ->sync($audiences);
    }
}