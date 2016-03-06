<?php

namespace App\Http\Controllers;

use App\Entities\Specialty;
use App\Repositories\SpecialtiesRepository;
use App\Services\DisciplineService;
use App\Services\SpecialtyService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SpecialtiesController extends Controller
{
    /**
     * @var SpecialtiesRepository
     */
    protected $specialtiesRepository;

    /**
     * @var SpecialtyService
     */
    protected $specialtyService;

    /**
     * @var DisciplineService
     */
    protected $disciplineService;

    /**
     * SpecialtiesController constructor.
     *
     * @param SpecialtyService $specialtyService
     * @param DisciplineService $disciplineService
     * @param SpecialtiesRepository $repository
     */
    public function __construct(
        SpecialtyService $specialtyService,
        DisciplineService $disciplineService,
        SpecialtiesRepository $repository
    )
    {
        $this->specialtyService = $specialtyService;
        $this->disciplineService = $disciplineService;

        $this->specialtiesRepository = $repository;
        $this->specialtiesRepository->setPresenter('App\Presenters\SpecialtyPresenter');
    }

    /**
     * Display a listing of the specialties.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->specialtiesRepository->with(['troops', 'disciplines'])->all();
    }

    /**
     * Display the specified Specialty.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->specialtiesRepository->withRelations(['troops', 'disciplines'])->find($id);
    }

    /**
     * Store a newly created Specialty in storage.
     *
     * @param Requests\SpecialtyRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\SpecialtyRequest $request)
    {
        $specialty = $this->specialtyService->create($request->all());

        if($request->exists('disciplines'))
        {
            $this->setDisciplines($specialty, $request->input('disciplines'));
        }

        return response('Created', 201);
    }

    /**
     * Update the specified Specialty in storage.
     *
     * @param  int $id
     * @param Requests\SpecialtyRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Requests\SpecialtyRequest $request)
    {
        $specialty = $this->specialtyService->attributesUpdate($id, $request->all());

        if($request->exists('disciplines'))
        {
            $this->setDisciplines($specialty, $request->input('disciplines'));
        }

        return response('Updated', 202);
    }

    /**
     * Sync with Disciplines
     *
     * @param Specialty $specialty
     * @param array $disciplinesIds
     */
    protected function setDisciplines(Specialty $specialty, array $disciplinesIds)
    {
        $disciplines = $this->disciplineService->getByIds($disciplinesIds);
        $this->specialtyService->syncDisciplines($specialty, $disciplines);
    }

    /**
     * Remove the specified Specialty from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $specialty = $this->specialtyService->delete($id);

        return response('Deleted', 202);
    }

    /**
     * Restore the specified Specialty in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $specialty = $this->specialtyService->restore($id);

        return response('Restored', 202);
    }

    /**
     * Get trashed Specialties
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        return $this->specialtiesRepository->onlyTrashed();
    }


}
