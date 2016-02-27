<?php

namespace App\Http\Controllers;

use App\Http\Requests\AudienceRequest;
use App\Repositories\AudiencesRepository;
use App\Services\AudienceService;
use App\Services\ThemeService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AudiencesController extends Controller
{
    /**
     * @var AudiencesRepository
     */
    protected $audiencesRepository;

    /**
     * @var AudienceService
     */
    protected $audiencesService;

    /**
     * @var ThemeService
     */
    protected $themeService;

    /**
     * AudienceController constructor.
     *
     * @param AudiencesRepository $audiencesRepository
     * @param AudienceService $audienceService
     * @param ThemeService $themeService
     */
    public function __construct
    (
        AudiencesRepository $audiencesRepository,
        AudienceService $audienceService,
        ThemeService $themeService
    )
    {
        $this->audiencesService = $audienceService;
        $this->themeService = $themeService;

        $this->audiencesRepository = $audiencesRepository;
        $this->audiencesRepository->setPresenter('App\Presenters\AudiencePresenter');
    }

    /**
     * Display a listing of the audiences.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->audiencesRepository->all();
    }

    /**
     * Store a newly created Audience in storage.
     *
     * @param AudienceRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AudienceRequest $request)
    {
        $this->audiencesService->create($request->all());

        return response('Created', 201);
    }

    /**
     * Display the specified Audience.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->audiencesRepository->find($id);
    }

    /**
     * Update the specified Audience in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AudienceRequest $request, $id)
    {
        $this->audiencesService->attributesUpdate($id, $request->all());

        return response('Updated', 202);
    }

    /**
     * Sync with Themes
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function setThemes($id, Request $request)
    {
        $ids = $request->input('themes');
        $themes = $this->themeService->getByIds($ids);

        $this->audiencesService->syncThemes($id, $themes);

        return response('Synced with themes', 202);
    }

    /**
     * Remove the specified Audience from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->audiencesService->delete($id);

        return response('Deleted', 202);
    }

    /**
     * Restore the specified Audience in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $this->audiencesService->restore($id);

        return response('Restored', 202);
    }
}
