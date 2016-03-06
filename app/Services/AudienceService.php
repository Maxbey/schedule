<?php

namespace App\Services;


use App\Entities\Audience;
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
     * @param Audience $audience
     * @param Collection $themes
     * @return array
     */
    public function syncThemes(Audience $audience, Collection $themes)
    {
        return $audience
            ->themes()
            ->sync($themes);
    }
}