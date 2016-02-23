<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TeachersRepository;
use App\Entities\Teacher;

/**
 * Class TeachersRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TeachersRepositoryEloquent extends BaseRepository implements TeachersRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Teacher::class;
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
        return 'App\Presenters\TeacherPresenter';
    }

    public function findByLastName($lastName)
    {
        return $this->findByField('lastname', $lastName);
    }
}
