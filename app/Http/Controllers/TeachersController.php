<?php

namespace App\Http\Controllers;

use App\Entities\Teacher;
use App\Http\Requests\TeacherRequest;
use App\Repositories\OccupationsRepository;
use App\Repositories\TeachersRepository;
use App\Services\TeacherService;
use App\Services\ThemeService;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TeachersController extends Controller
{
    /**
     * @var TeachersRepository
     */
    protected $teachersRepository;

    /**
     * @var OccupationsRepository
     */
    protected $occupationsRepository;

    /**
     * @var TeacherService
     */
    protected $teacherService;

    /**
     * @var ThemeService
     */
    protected $themeService;

    /**
     * TeachersController constructor.
     *
     * @param TeachersRepository $teachersRepository
     * @param TeacherService $teacherService
     * @param ThemeService $themeService
     * @param OccupationsRepository $occupationsRepository\
     */
    public function __construct
    (
        TeachersRepository $teachersRepository,
        TeacherService $teacherService,
        ThemeService $themeService,
        OccupationsRepository $occupationsRepository
    )
    {
        $this->teacherService = $teacherService;
        $this->themeService = $themeService;

        $this->teachersRepository = $teachersRepository;
        $this->occupationsRepository = $occupationsRepository;
        $this->teachersRepository->setPresenter('App\Presenters\TeacherPresenter');
    }

    /**
     * Display a listing of the teachers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->teachersRepository->all();
    }

    /**
     * Store a newly created Teacher in storage.
     *
     * @param TeacherRequest
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherRequest $request)
    {
        $teacher = $this->teacherService->create($request->all());

        if($request->exists('themes'))
        {
            $this->setThemes($teacher, $request->input('themes'));
        }

        return response('Created', 201);
    }

    /**
     * Display the specified Teacher.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->teachersRepository->find($id);
    }

    /**
     * Return json of occupations by given teacher and date period
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function findByTeacherAndPeriod($id, Request $request)
    {
        $teacher = $this->teachersRepository->find($id);

        return $this->occupationsRepository->setPresenter('App\Presenters\OccupationPresenter')
            ->findByTeacherAndPeriod($teacher, Carbon::parse($request->input('from')), Carbon::parse($request->input('to')));
    }

    /**
     * @param TeacherRequest $request
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update(TeacherRequest $request, $id)
    {
        $teacher = $this->teacherService->attributesUpdate($id, $request->all());

        if($request->exists('themes'))
        {
            $this->setThemes($teacher, $request->input('themes'));
        }

        return response('Updated', 202);
    }

    /**
     * Remove the specified Teacher from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->teacherService->delete($id);

        return response('Deleted', 202);
    }

    /**
     * Restore the specified Teacher in storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function restore($id)
    {
        $this->teacherService->restore($id);

        return response('Restored', 202);
    }

    /**
     * Get trashed Teachers
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        return $this->teachersRepository->onlyTrashed();
    }

    /**
     * Sync with themes.
     *
     * @param Teacher $teacher
     * @param array $themesIds
     */
    public function setThemes(Teacher $teacher, array $themesIds)
    {
        $themes = $this->themeService->getByIds($themesIds);
        $this->teacherService->syncThemes($teacher, $themes);
    }
}
