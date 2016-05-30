<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TermsRepository;
use App\Entities\Term;

/**
 * Class TermRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TermsRepositoryEloquent extends Repository implements TermsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Term::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
