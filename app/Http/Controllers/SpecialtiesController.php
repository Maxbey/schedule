<?php

namespace App\Http\Controllers;

use App\Repositories\SpecialtiesRepository;
use App\Services\DisciplineService;
use App\Services\SpecialtyService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SpecialtiesController extends Controller
{
    protected $specialtiesRepository;

    protected $specialtyService;

    protected $disciplineService;

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

    public function index()
    {
        return $this->specialtiesRepository->all();
    }

    public function show($id)
    {
        return $this->specialtiesRepository->with(['troops'])->find($id);
    }

    public function store(Requests\SpecialtyRequest $request)
    {
        $specialty = $this->specialtyService->create($request->all());

        return response('Created', 201);
    }

    public function update($id, Requests\SpecialtyRequest $request)
    {
        $specialty = $this->specialtyService->update($id, $request->all());

        return response('Updated', 202);
    }

    public function updateDisciplines($id, Request $request)
    {
        $ids = $request->input('disciplines');
        $disciplines = $this->disciplineService->getByIds($ids);

        $this->specialtyService->syncDisciplines($id, $disciplines);

        return response('Synced with disciplines', 202);
    }

    public function destroy($id)
    {
        $specialty = $this->specialtyService->delete($id);

        return response('Deleted', 202);
    }

    public function restore($id)
    {
        $specialty = $this->specialtyService->restore($id);

        return response('Restored', 202);
    }


}
