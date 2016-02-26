<?php

namespace App\Services;


use App\Repositories\TeachersRepository;
use Illuminate\Database\Eloquent\Collection;

class TeacherService extends EntityService
{
    protected function repository()
    {
        return 'App\Repositories\TeachersRepository';
    }

    public function create(array $attributes)
    {
        return $this->teachersRepository->create($attributes);
    }

    public function attachThemes($teacherId, Collection $themes)
    {
        return $this->getById($teacherId)->themes()->sync($themes);
    }
}