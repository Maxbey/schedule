<?php

Route::get('/', 'AngularController@serveApp');

Route::get('/unsupported-browser', 'AngularController@unsupported');

$api->group([], function ($api) {

    $api->post('users/login', 'LoginController@login');

});

//protected routes with JWT (must be logged in to access any of these routes)
$api->group(['middleware' => 'api.auth'], function ($api) {

    $api->get('sample/protected', 'LoginController@protectedData');

});

Route::group(['prefix' => 'api'], function(){

    /* Specialties */
    /*Route::put('specialties/{id}', [
        'uses' => 'SpecialtiesController@restore',
        'as'   => 'api.specialties.restore'
    ]);*/

    Route::resource('specialties', 'SpecialtiesController', [
        'parameters' => [
            'specialties' => 'id'
        ],
        'except' =>
            ['create', 'edit']
    ]);

    Route::get('trashcan/specialties', 'SpecialtiesController@trashed');

    /* Disciplines */
    /*Route::put('disciplines/{id}', [
        'uses' => 'DisciplinesController@restore',
        'as'   => 'api.disciplines.restore'
    ]);*/

    Route::resource('disciplines', 'DisciplinesController', [
        'parameters' => [
            'disciplines' => 'id'
        ],
        'except' =>
            ['create', 'edit']
    ]);

    Route::get('trashcan/disciplines', 'DisciplinesController@trashed');

    /* Troops */
    /*Route::put('troops/{id}', [
        'uses' => 'TroopsController@restore',
        'as'   => 'api.troops.restore'
    ]);*/

    Route::resource('troops', 'TroopsController', [
        'parameters' => [
            'troops' => 'id'
        ],
        'except' =>
            ['create', 'edit']
    ]);

    Route::get('trashcan/troops', 'TroopsController@trashed');

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

    Route::get('trashcan/teachers', 'TeachersController@trashed');

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

    Route::get('trashcan/themes', 'ThemesController@trashed');

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

    Route::get('trashcan/audiences', 'AudiencesController@trashed');

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

    Route::get('trashcan/occupations', 'OccupationsController@trashed');
});
