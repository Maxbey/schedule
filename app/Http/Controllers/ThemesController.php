<?php

namespace App\Http\Controllers;

use App\Entities\Theme;
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
     * @param ThemeRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ThemeRequest $request)
    {
        $discipline = $this->disciplinesRepository->find($request->input('discipline_id'));

        $theme = $this->themesService->create($discipline, $request->all());

        if($request->exists('audiences'))
        {
            $this->setAudiences($theme, $request->input('audiences'));
        }
        if($request->exists('teachers'))
        {
            $this->setTeachers($theme, $request->input('teachers'));
        }
        /*if($request->exists('prev_theme_id'))
        {
            $prev = $this->themesService->getById($request->input('prev_theme_id'));
            $this->themesService->setPrevTheme($theme, $prev);
        }*/

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
     * @param ThemeRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ThemeRequest $request, $id)
    {
        $discipline = $this->disciplinesRepository->find($request->input('discipline_id'));

        $theme = $this->themesService->update($id, $discipline, $request->all());

        if($request->exists('audiences'))
        {
            $this->setAudiences($theme, $request->input('audiences'));
        }
        if($request->exists('teachers'))
        {
            $this->setTeachers($theme, $request->input('teachers'));
        }

        return response('Updated', 202);
    }

    /**
     * Sync with Audiences
     *
     * @param Theme $theme
     * @param array $audienceIds
     */
    public function setAudiences(Theme $theme, array $audienceIds)
    {
        $audiences = $this->audienceService->getByIds($audienceIds);
        $this->themesService->syncAudiences($theme, $audiences);
    }

    /**
     * Sync with Teachers
     *
     * @param Theme $theme
     * @param array $teachersIds
     */
    public function setTeachers(Theme $theme, array $teachersIds)
    {
        $teachers = $this->teacherService->getByIds($teachersIds);
        $this->themesService->syncTeachers($theme, $teachers);
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
