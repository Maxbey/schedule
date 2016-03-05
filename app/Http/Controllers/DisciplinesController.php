<?php

namespace App\Http\Controllers;

use App\Http\Requests\DisciplineRequest;
use App\Repositories\DisciplinesRepository;
use App\Services\DisciplineService;
use App\Services\SpecialtyService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DisciplinesController extends Controller
{
    /**
     * @var DisciplinesRepository
     */
    protected $disciplinesRepository;

    /**
     * @var DisciplineService
     */
    protected $disciplineService;

    /**
     * @var SpecialtyService
     */
    protected $specialtyService;

    /**
     * DisciplinesController constructor.
     *
     * @param DisciplinesRepository $disciplinesRepository
     * @param DisciplineService $disciplineService
     * @param SpecialtyService $specialtyService
     */
    public function __construct
    (
        DisciplinesRepository $disciplinesRepository,
        DisciplineService $disciplineService,
        SpecialtyService $specialtyService
    )
    {
        $this->disciplineService = $disciplineService;
        $this->specialtyService = $specialtyService;

        $this->disciplinesRepository = $disciplinesRepository;
        $this->disciplinesRepository->setPresenter('App\Presenters\DisciplinePresenter');
    }


    /**
     * Display a listing of the disciplines.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->disciplinesRepository->all();
    }

    /**
     * Store a newly created Discipline in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DisciplineRequest $request)
    {
        $discipline = $this->disciplineService->create($request->all());

        return response('Created', 201);
    }

    /**
     * Display the specified Discipline.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->disciplinesRepository->withRelations(['specialties', 'themes'])->find($id);
    }

    /**
     * Update the specified Discipline in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DisciplineRequest $request, $id)
    {
        $this->disciplineService->attributesUpdate($id, $request->all());

        return response('Updated', 202);
    }

    /**
     * Remove the specified Discipline from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->disciplineService->delete($id);

        return response('Deleted', 202);
    }

    /**
     * Restore the specified Discipline in storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function restore($id)
    {
        $this->disciplineService->restore($id);

        return response('Restore', 202);
    }

    /**
     * Get trashed Disciplines
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        return $this->disciplinesRepository->onlyTrashed();
    }

    /**
     * Sync with Specialties
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function setSpecialties($id, Request $request)
    {
        $ids = $request->input('specialties');
        $specialties = $this->specialtyService->getByIds($ids);

        $this->disciplineService->syncSpecialties($id, $specialties);

        return response('Synced with specialties', 202);
    }
}
