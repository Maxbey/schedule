<?php

namespace App\Http\Controllers;

use App\Entities\Occupation;
use App\Entities\Troop;
use App\Http\Requests\OccupationRequest;
use App\Repositories\OccupationsRepository;
use App\Repositories\ThemesRepository;
use App\Repositories\TroopsRepository;
use App\Services\AudienceService;
use App\Services\OccupationService;
use App\Services\TeacherService;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OccupationsController extends Controller
{
    /**
     * @var OccupationsRepository
     */
    protected $occupationsRepository;

    /**
     * @var TroopsRepository
     */
    protected $troopsRepository;

    /**
     * @var ThemesRepository
     */
    protected $themesRepository;

    /**
     * @var OccupationService
     */
    protected $occupationService;

    /**
     * @var TeacherService
     */
    protected $teacherService;

    /**
     * @var AudienceService
     */
    protected $audienceService;

    /**
     * OccupationsController constructor.
     *
     * @param OccupationsRepository $occupationsRepository
     * @param ThemesRepository $themesRepository
     * @param TroopsRepository $troopsRepository
     * @param OccupationService $occupationService
     * @param TeacherService $teacherService
     * @param AudienceService $audienceService
     */
    public function __construct
    (
        OccupationsRepository $occupationsRepository,
        ThemesRepository $themesRepository,
        TroopsRepository $troopsRepository,
        OccupationService $occupationService,
        TeacherService $teacherService,
        AudienceService $audienceService
    )
    {
        $this->occupationService = $occupationService;
        $this->teacherService = $teacherService;
        $this->audienceService = $audienceService;

        $this->themesRepository = $themesRepository;
        $this->troopsRepository = $troopsRepository;

        $this->occupationsRepository = $occupationsRepository;
        $this->occupationsRepository->setPresenter('App\Presenters\OccupationPresenter');
    }

    /**
     * Display a listing of the occupations.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->occupationsRepository->all();
    }

    /**
     * Store a newly created Occupation in storage.
     *
     * @param OccupationRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(OccupationRequest $request)
    {
        $theme = $this->themesRepository->find($request->input('theme_id'));
        $troop = $this->troopsRepository->find($request->input('troop_id'));

        $occupation = $this->occupationService->create($theme, $troop, $request->all());

        if($request->exists('audiences'))
        {
            $this->setAudiences($occupation, $request->input('audiences'));
        }
        if($request->exists('teachers'))
        {
            $this->setTeachers($occupation, $request->input('teachers'));
        }

        return response('Created', 201);
    }

    /**
     * Display the specified Occupation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->occupationsRepository->withRelations(['teachers', 'audiences', 'theme'])->find($id);
    }

    /**
     * Update the specified Occupation in storage.
     *
     * @param OccupationRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(OccupationRequest $request, $id)
    {
        $theme = $this->themesRepository->find($request->input('theme_id'));
        $troop = $this->troopsRepository->find($request->input('troop_id'));

        $occupation = $this->occupationService->update($id, $theme, $troop, $request->all());

        if($request->exists('audiences'))
        {
            $this->setAudiences($occupation, $request->input('audiences'));
        }
        if($request->exists('teachers'))
        {
            $this->setTeachers($occupation, $request->input('teachers'));
        }

        return response('Updated', 202);
    }

    /**
     * Sync with Audiences
     *
     * @param Occupation $occupation
     * @param array $audienceIds
     */
    public function setAudiences(Occupation $occupation, array $audienceIds)
    {
        $audiences = $this->audienceService->getByIds($audienceIds);
        $this->occupationService->syncAudiences($occupation, $audiences);
    }

    /**
     * Sync with Teachers
     *
     * @param Occupation $occupation
     * @param array $teachersIds
     */
    public function setTeachers(Occupation $occupation, array $teachersIds)
    {
        $teachers = $this->teacherService->getByIds($teachersIds);
        $this->occupationService->syncTeachers($occupation, $teachers);
    }

    /**
     * Remove the specified Occupation from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->occupationService->delete($id);

        return response('Deleted', 202);
    }

    /**
     * Restore the specified Occupation in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $this->occupationService->restore($id);

        return response('Restored', 202);
    }

    /**
     * Get trashed Occupations
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        return $this->occupationsRepository->onlyTrashed();
    }
}
