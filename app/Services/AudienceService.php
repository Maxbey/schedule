<?php
/**
 * Created by PhpStorm.
 * User: maxbey
 * Date: 23.02.16
 * Time: 22:24
 */

namespace App\Services;


use App\Repositories\AudiencesRepository;

class AudienceService
{
    protected $audiencesRepository;

    public function __construct(AudiencesRepository $audiencesRepository)
    {
        $this->audiencesRepository = $audiencesRepository;
    }

    public function getById($id)
    {
        return $this->audiencesRepository->find($id);
    }

    public function getByIds(array $ids)
    {
        return $this->audiencesRepository->findWhereIn('id', $ids);
    }

    public function create(array $attributes)
    {
        return $this->audiencesRepository->create($attributes);
    }

    public function delete($id)
    {
        return $this->audiencesRepository->delete($id);
    }

    public function restore($id)
    {
        return $this->audiencesRepository->restore($id);
    }

    public function attachThemes($audienceId, array $themes)
    {
        return $this->getById($audienceId)
            ->themes()
            ->sync($themes);
    }

}