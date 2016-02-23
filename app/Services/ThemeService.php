<?php

namespace App\Services;


use App\Entities\Discipline;
use App\Repositories\ThemesRepository;

class ThemeService
{
    protected $themesRepository;

    public function __construct(ThemesRepository $themesRepository)
    {
        $this->themesRepository = $themesRepository;
    }

    public function create(Discipline $discipline, array $attributes)
    {
        return $discipline->themes()->create($attributes);
    }

    public function delete($themeId)
    {
        $this->themesRepository->delete($themeId);
    }

    public function restore($themeId)
    {
        $this->themesRepository->restore($themeId);
    }

    public function attachTeachers($themeId, array $teachers)
    {
        return $this->getById($themeId)
            ->teachers()
            ->sync($teachers);
    }

    public function attachAudiences($audienceId, array $audiences)
    {
        return $this->getById($audienceId)
            ->audiences()
            ->sync($audiences);
    }

    public function getById($id)
    {
        return $this->themesRepository->find($id);
    }

    public function getByIds(array $ids)
    {
        return $this->themesRepository->findWhereIn('id', $ids);
    }
}