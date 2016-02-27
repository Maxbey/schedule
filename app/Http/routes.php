<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api'], function(){

    /* Specialties */
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

    Route::post('specialties/{id}/disciplines', [
        'uses' => 'SpecialtiesController@setDisciplines',
        'as'   => 'api.specialties.setDisciplines'
    ]);

    /* Disciplines */
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

    Route::post('disciplines/{id}/specialties', [
        'uses' => 'DisciplinesController@setSpecialties',
        'as'   => 'api.disciplines.setSpecialties'
    ]);

    /* Troops */
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

    /* Teachers */
    Route::resource('teachers', 'TeachersController', [
        'parameters' => [
            'teachers' => 'id'
        ],
        'except' =>
            ['create', 'edit']
    ]);

    Route::put('teachers/{id}', [
        'uses' => 'TeachersController@restore',
        'as'   => 'api.teachers.restore'
    ]);

    Route::resource('teachers', 'TeachersController', [
        'parameters' => [
            'teachers' => 'id'
        ],
        'except' =>
            ['create', 'edit']
    ]);

    Route::post('teachers/{id}/themes', [
        'uses' => 'TeachersController@setThemes',
        'as'   => 'api.teachers.setThemes'
    ]);


    /* Themes */
    Route::put('themes/{id}', [
        'uses' => 'ThemesController@restore',
        'as'   => 'api.themes.restore'
    ]);

    Route::resource('themes', 'ThemesController', [
        'parameters' => [
            'themes' => 'id'
        ],
        'except' =>
            ['create', 'edit']
    ]);

    Route::post('themes/{id}/audiences', [
        'uses' => 'ThemesController@setAudiences',
        'as'   => 'api.themes.setAudiences'
    ]);

    Route::post('themes/{id}/teachers', [
        'uses' => 'ThemesController@setTeachers',
        'as'   => 'api.themes.setTeachers'
    ]);

    /*Audiences*/
    Route::put('audiences/{id}', [
        'uses' => 'AudiencesController@restore',
        'as'   => 'api.audiences.restore'
    ]);

    Route::resource('audiences', 'AudiencesController', [
        'parameters' => [
            'audiences' => 'id'
        ],
        'except' =>
            ['create', 'edit']
    ]);

    Route::post('audiences/{id}/themes', [
        'uses' => 'AudiencesController@setThemes',
        'as'   => 'api.audiences.setThemes'
    ]);

    /*Occupations*/
    Route::put('occupations/{id}', [
        'uses' => 'OccupationsController@restore',
        'as'   => 'api.occupations.restore'
    ]);

    Route::resource('occupations', 'OccupationsController', [
        'parameters' => [
            'occupations' => 'id'
        ],
        'except' =>
            ['create', 'edit']
    ]);
});
