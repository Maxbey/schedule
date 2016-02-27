<?php

namespace App\Services;


use App\Repositories\AudiencesRepository;
use Illuminate\Database\Eloquent\Collection;

class AudienceService extends EntityService
{
    /**
     * Define repository.
     *
     * @return string
     */
    protected function repository()
    {
        return 'App\Repositories\AudiencesRepository';
    }

    /**
     * Create instance of Audience
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
     * @param int $audienceId
     * @param Collection $themes
     * @return mixed
     */
    public function syncThemes($audienceId, Collection $themes)
    {
        return $this->getById($audienceId)
            ->themes()
            ->sync($themes);
    }
}