<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api'], function(){

    Route::put('specialties/{id}', [
        'uses' => 'SpecialtiesController@restore',
        'as'   => 'api.specialties.restore'
    ]);

    Route::resource('specialties', 'SpecialtiesController', [
        'parameters' => [
            'specialties' => 'id'
        ],
        'except' =>
            ['create', 'edit']
    ]);

    Route::post('specialties/{id}/disciplines', 'SpecialtiesController@updateDisciplines');


    Route::put('disciplines/{id}', [
        'uses' => 'DisciplinesController@restore',
        'as'   => 'api.disciplines.restore'
    ]);

    Route::resource('disciplines', 'DisciplinesController', [
        'parameters' => [
            'disciplines' => 'id'
        ],
        'except' =>
            ['create', 'edit']
    ]);

    Route::post('disciplines/{id}/specialties', 'DisciplinesController@updateSpecialties');


    Route::put('troops/{id}', [
        'uses' => 'TroopsController@restore',
        'as'   => 'api.troops.restore'
    ]);

    Route::resource('troops', 'TroopsController', [
        'parameters' => [
            'troops' => 'id'
        ],
        'except' =>
            ['create', 'edit']
    ]);
});
