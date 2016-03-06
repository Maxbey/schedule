<?php

namespace App\Http\Controllers;

use App\Entities\Audience;
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
        $audience = $this->audiencesService->create($request->all());

        if($request->exists('themes'))
        {
            $this->setThemes($audience, $request->input('themes'));
        }

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
        return $this->audiencesRepository->withRelations(['themes'])->find($id);
    }

    /**
     * Update the specified Audience in storage.
     *
     * @param AudienceRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AudienceRequest $request, $id)
    {
        $audience = $this->audiencesService->attributesUpdate($id, $request->all());

        if($request->exists('themes'))
        {
            $this->setThemes($audience, $request->input('themes'));
        }

        return response('Updated', 202);
    }

    /**
     * Sync with Themes
     *
     * @param Audience $audiecne
     * @param array $themesIds
     */
    public function setThemes(Audience $audiecne, array $themesIds)
    {
        $themes = $this->themeService->getByIds($themesIds);
        $this->audiencesService->syncThemes($audiecne, $themes);
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

    /**
     * Get trashed Audiences
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        return $this->audiencesRepository->onlyTrashed();
    }
}
