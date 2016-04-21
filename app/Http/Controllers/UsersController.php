<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * @var UsersRepository
     */
    protected $usersRepository;

    /**
     * UsersController constructor.
     *
     * @param UsersRepository $repo
     */
    public function __construct(UsersRepository $repo)
    {
        $this->usersRepository = $repo;
        $this->usersRepository->setPresenter('App\Presenters\UserPresenter');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->usersRepository->all();
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->usersRepository->create($request->all());

        return response('Created', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->usersRepository->delete($id);

        return response('Deleted', 202);
    }
}
