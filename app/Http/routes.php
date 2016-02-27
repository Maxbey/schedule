<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api'], function(){
    Route::resource('specialties', 'SpecialtiesController', [
        'parameters' => [
            'specialties' => 'id'
        ],
        'except' =>
            ['create', 'edit']
    ]);

    Route::put('specialties/{id}', [
        'uses' => 'SpecialtiesController@restore',
        'as'   => 'api.specialties.restore'
    ]);
    
    Route::post('specialties/{id}/disciplines', 'SpecialtiesController@updateDisciplines');
});
