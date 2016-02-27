<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Repositories\TeachersRepository;
use App\Services\TeacherService;
use App\Services\ThemeService;
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
     */
    public function __construct
    (
        TeachersRepository $teachersRepository,
        TeacherService $teacherService,
        ThemeService $themeService
    )
    {
        $this->teacherService = $teacherService;
        $this->themeService = $themeService;

        $this->teachersRepository = $teachersRepository;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherRequest $request)
    {
        $this->teacherService->create($request->all());

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
     * Update the specified resource in Teacher.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeacherRequest $request, $id)
    {
        $this->teacherService->attributesUpdate($id, $request->all());

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
     * Sync with themes.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function updateThemes($id, Request $request)
    {
        $ids = $request->input('themes');
        $themes = $this->themeService->getByIds($ids);

        $this->teacherService->syncThemes($id, $themes);

        return response('Synced with themes', 202);
    }
}
