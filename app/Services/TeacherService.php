<?php

namespace App\Services;


use App\Entities\Teacher;
use App\Repositories\TeachersRepository;
use Illuminate\Database\Eloquent\Collection;

class TeacherService extends EntityService
{
    /**
     * Define repository.
     *
     * @return string
     */
    protected function repository()
    {
        return 'App\Repositories\TeachersRepository';
    }

    /**
     * Create instance of Teacher
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->repository->create($attributes);
    }

    /**
     * Sync Themes through relation
     *
     * @param Teacher $teacher
     * @param Collection $themes
     * @return array
     */
    public function syncThemes(Teacher $teacher, Collection $themes)
    {
        return $teacher->themes()->sync($themes);
    }
}