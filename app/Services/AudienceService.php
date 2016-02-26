<?php

namespace App\Services;


use App\Repositories\AudiencesRepository;
use Illuminate\Database\Eloquent\Collection;

class AudienceService extends EntityService
{
    protected function repository()
    {
        return 'App\Repositories\AudiencesRepository';
    }

    public function create(array $attributes)
    {
        return $this->repository->create($attributes);
    }

    public function syncThemes($audienceId, Collection $themes)
    {
        return $this->getById($audienceId)
            ->themes()
            ->sync($themes);
    }
}