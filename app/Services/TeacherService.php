<?php

namespace App\Services;


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
     * @param int $teacherId
     * @param Collection $themes
     * @return mixed
     */
    public function syncThemes($teacherId, Collection $themes)
    {
        return $this->getById($teacherId)->themes()->sync($themes);
    }
}