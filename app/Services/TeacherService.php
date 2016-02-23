<?php

namespace App\Services;


use App\Repositories\TeachersRepository;

class TeacherService
{
    protected $teachersRepository;

    public function __construct(TeachersRepository $teachersRepository)
    {
        $this->teachersRepository = $teachersRepository;
    }

    public function create(array $attributes)
    {
        return $this->teachersRepository->create($attributes);
    }

    public function delete($id)
    {
        return $this->teachersRepository->delete($id);
    }

    public function restore($id)
    {
        return $this->teachersRepository->restore($id);
    }

    public function getByIds(array $ids)
    {
        return $this->teachersRepository->findWhereIn('id', $ids);
    }

    public function getById($id)
    {
        return $this->teachersRepository->find($id);
    }

    public function attachThemes($teacherId, array $themes)
    {
        return $this->getById($teacherId)->themes()->sync($themes);
    }
}