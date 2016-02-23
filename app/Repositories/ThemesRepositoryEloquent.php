<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ThemesRepository;
use App\Entities\Theme;

/**
 * Class ThemesRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ThemesRepositoryEloquent extends BaseRepository implements ThemesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Theme::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Set the presenter
     *
     * @return string
     */
    public function presenter()
    {
        return 'App\Presenters\ThemePresenter';
    }

    public function findByTerm($termNumber)
    {
        return $this->findByField('term', $termNumber);
    }
}
