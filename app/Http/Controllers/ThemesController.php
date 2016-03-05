<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThemeRequest;
use App\Repositories\DisciplinesRepository;
use App\Repositories\ThemesRepository;
use App\Services\AudienceService;
use App\Services\TeacherService;
use App\Services\ThemeService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ThemesController extends Controller
{
    /**
     * @var ThemesRepository
     */
    protected $themesRepository;

    /**
     * @var DisciplinesRepository
     */
    protected $disciplinesRepository;

    /**
     * @var ThemeService
     */
    protected $themesService;

    /**
     * @var AudienceService
     */
    protected $audienceService;

    /**
     * @var TeacherService
     */
    protected $teacherService;

    /**
     * ThemesController constructor.
     *
     * @param ThemesRepository $themesRepository
     * @param DisciplinesRepository $disciplinesRepository
     * @param ThemeService $themeService
     * @param AudienceService $audiencesService
     * @param TeacherService $teacherService
     */
    public function __construct
    (
        ThemesRepository $themesRepository,
        DisciplinesRepository $disciplinesRepository,
        ThemeService $themeService,
        AudienceService $audiencesService,
        TeacherService $teacherService
    )
    {
        $this->themesService = $themeService;
        $this->audienceService = $audiencesService;
        $this->teacherService = $teacherService;

        $this->themesRepository = $themesRepository;
        $this->themesRepository->setPresenter('App\Presenters\ThemePresenter');

        $this->disciplinesRepository = $disciplinesRepository;
    }

    /**
     * Display a listing of the themes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->themesRepository->all();
    }

    /**
     * Store a newly created Theme in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ThemeRequest $request)
    {
        $discipline = $this->disciplinesRepository->find($request->input('discipline_id'));

        $this->themesService->create($discipline, $request->all());

        return response('Created', 201);
    }

    /**
     * Display the specified Theme.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->themesRepository->withRelations(['teachers', 'audiences'])->find($id);
    }

    /**
     * Update the specified Theme in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ThemeRequest $request, $id)
    {
        $discipline = $this->disciplinesRepository->find($request->input('discipline_id'));

        $this->themesService->update($id, $discipline, $request->all());

        return response('Updated', 202);
    }

    /**
     * Sync with Audiences
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function setAudiences($id, Request $request)
    {
        $ids = $request->input('audiences');
        $audiences = $this->audienceService->getByIds($ids);

        $this->themesService->syncAudiences($id, $audiences);

        return response('Synced with audiences', 202);

    }

    /**
     * Sync with Teachers
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function setTeachers($id, Request $request)
    {
        $ids = $request->input('teachers');
        $teachers = $this->teacherService->getByIds($ids);

        $this->themesService->syncTeachers($id, $teachers);

        return response('Synced with teachers', 202);
    }

    /**
     * Remove the specified Theme from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->themesService->delete($id);

        return response('Deleted', 202);
    }

    /**
     * Restore the specified Theme in storage.
     *
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function restore($id)
    {
        $this->themesService->restore($id);

        return response('Restored', 202);
    }

    /**
     * Get trashed Themes
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        return $this->themesRepository->onlyTrashed();
    }
}
