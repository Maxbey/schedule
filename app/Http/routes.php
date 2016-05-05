<?php

Route::get('/', 'AngularController@serveApp');

Route::get('/unsupported-browser', 'AngularController@unsupported');

$api->group([], function ($api) {
    $api->post('users/login', 'LoginController@login');
    $api->get('auth/user', 'LoginController@authorizedUser');
});

//protected routes with JWT (must be logged in to access any of these routes)
$api->group([], function ($api) {
    /* Users */
    $api->resource('users', 'UsersController', [
        'parameters' => [
            'users' => 'id'
        ],
        'excerpt' => [
            'create, show, edit'
        ]
    ]);


    /* Specialties */
    $api->resource('specialties', 'SpecialtiesController', [
        'parameters' => [
            'specialties' => 'id'
        ],
        'except' =>
            ['create', 'edit']
    ]);

    $api->get('trashcan/specialties', 'SpecialtiesController@trashed');

    /* Disciplines */

    $api->resource('disciplines', 'DisciplinesController', [
        'parameters' => [
            'disciplines' => 'id'
        ],
        'except' =>
            ['create', 'edit']
    ]);

    $api->get('trashcan/disciplines', 'DisciplinesController@trashed');

    /* Troops */

    $api->resource('troops', 'TroopsController', [
        'parameters' => [
            'troops' => 'id'
        ],
        'except' =>
            ['create', 'edit', 'all']
    ]);

    $api->get('trashcan/troops', 'TroopsController@trashed');

    /* Teachers */
    $api->resource('teachers', 'TeachersController', [
        'parameters' => [
            'teachers' => 'id'
        ],
        'except' =>
            ['create', 'edit']
    ]);

    $api->resource('teachers', 'TeachersController', [
        'parameters' => [
            'teachers' => 'id'
        ],
        'except' =>
            ['create', 'edit']
    ]);

    $api->get('trashcan/teachers', 'TeachersController@trashed');

    /* Themes */

    $api->resource('themes', 'ThemesController', [
        'parameters' => [
            'themes' => 'id'
        ],
        'except' =>
            ['create', 'edit']
    ]);

    $api->get('trashcan/themes', 'ThemesController@trashed');

    /*Audiences*/

    $api->resource('audiences', 'AudiencesController', [
        'parameters' => [
            'audiences' => 'id'
        ],
        'except' =>
            ['create', 'edit']
    ]);

    $api->get('trashcan/audiences', 'AudiencesController@trashed');

    /*Occupations*/

    $api->resource('occupations', 'OccupationsController', [
        'parameters' => [
            'occupations' => 'id'
        ],
        'except' =>
            ['create', 'edit']
    ]);

    $api->get('trashcan/occupations', 'OccupationsController@trashed');
});

$api->group([], function ($api) {
  $api->get('troops', 'TroopsController@index');
  $api->get('troops/{id}/occupations', 'OccupationsController@findByTroopAndDate');
});

Route::get('api/schedule', 'ScheduleController@index');

Route::get('api/schedule/export', 'ScheduleController@export');
