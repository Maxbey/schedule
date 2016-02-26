<?php

namespace App\Http\Controllers;

use App\Repositories\SpecialtiesRepository;
use App\Services\SpecialtyService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SpecialtiesController extends Controller
{
    protected $specialtiesRepository;
    protected $specialtyService;

    public function __construct(SpecialtyService $service, SpecialtiesRepository $repository)
    {
        $this->specialtyService = $service;
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

        return response('Специальность ' . $specialty->name . ' создана', 201);
    }

    public function update($id, Requests\SpecialtyRequest $request)
    {
        $specialty = $this->specialtyService->update($id, $request->all());

        return response('Специальность ' . $specialty->name . ' обновлена', 202);
    }

    public function destroy($id)
    {
        $specialty = $this->specialtyService->delete($id);

        return response('Специальность ' . $specialty->name . ' удалена', 202);
    }

    public function restore($id)
    {
        $specialty = $this->specialtyService->restore($id);

        return response('Специальность ' . $specialty->name . ' восстановлена', 202);
    }


}
