<?php

namespace App\Http\Controllers;

use App\Entities\Occupation;
use App\Entities\Troop;
use App\Http\Requests\OccupationRequest;
use App\Repositories\OccupationsRepository;
use App\Services\OccupationService;
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
     * @var OccupationService
     */
    protected $occupationService;

    /**
     * OccupationsController constructor.
     *
     * @param OccupationsRepository $occupationsRepository
     * @param OccupationService $occupationService
     */
    public function __construct(OccupationsRepository $occupationsRepository, OccupationService $occupationService)
    {
        $this->occupationService = $occupationService;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OccupationRequest $request)
    {
        $this->occupationService->create($request->all());

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
        return $this->occupationsRepository->find($id);
    }

    /**
     * Update the specified Occupation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OccupationRequest $request, $id)
    {
        $this->occupationService->update($id, $request->all());

        return response('Updated', 202);
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
}
