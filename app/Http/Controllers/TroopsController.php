<?php

namespace App\Http\Controllers;

use App\Http\Requests\TroopRequest;
use App\Repositories\TroopsRepository;
use App\Services\SpecialtyService;
use App\Services\TroopService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TroopsController extends Controller
{
    /**
     * @var TroopsRepository
     */
    protected $troopsRepository;

    /**
     * @var TroopService
     */
    protected $troopService;

    /**
     * @var SpecialtyService
     */
    protected $specialtyService;

    /**
     * TroopsController constructor.
     *
     * @param TroopsRepository $troopsRepository
     * @param TroopService $troopService
     * @param SpecialtyService $specialtyService
     */
    public function __construct
    (
        TroopsRepository $troopsRepository,
        TroopService $troopService,
        SpecialtyService $specialtyService
    )
    {
        $this->troopService = $troopService;
        $this->specialtyService = $specialtyService;

        $this->troopsRepository = $troopsRepository;
        $this->troopsRepository->setPresenter('App\Presenters\TroopPresenter');
    }

    /**
     * Display a listing of the troops.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->troopsRepository->all();
    }

    /**
     * Store a newly created Troop in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TroopRequest $request)
    {
        $specialty = $this->specialtyService->getById($request->get('specialty_id'));

        $this->troopService->create($specialty, $request->all());

        return response('Created', 201);
    }

    /**
     * Display the specified Troop.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->troopsRepository->find($id);
    }

    /**
     * Update the specified Troop in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TroopRequest $request, $id)
    {
        $specialty = $this->specialtyService->getById($request->get('specialty_id'));

        $this->troopService->update($id, $specialty, $request->all());

        return response('Updated', 202);
    }

    /**
     * Remove the specified Troop from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->troopService->delete($id);

        return response('Deleted', 202);
    }

    /**
     * Restore Troop in storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function restore($id)
    {
        $this->troopService->restore($id);

        return response('Restored', 202);
    }
}
