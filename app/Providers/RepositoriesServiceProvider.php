<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\\Repositories\\AudiencesRepository',
            'App\\Repositories\\AudiencesRepositoryEloquent'
        );

        $this->app->bind(
            'App\\Repositories\\DisciplinesRepository',
            'App\\Repositories\\DisciplinesRepositoryEloquent'
        );

        $this->app->bind(
            'App\\Repositories\\OccupationsRepository',
            'App\\Repositories\\OccupationsRepositoryEloquent'
        );

        $this->app->bind(
            'App\\Repositories\\SpecialtiesRepository',
            'App\\Repositories\\SpecialtiesRepositoryEloquent'
        );

        $this->app->bind(
            'App\\Repositories\\TeachersRepository',
            'App\\Repositories\\TeachersRepositoryEloquent'
        );

        $this->app->bind(
            'App\\Repositories\\ThemesRepository',
            'App\\Repositories\\ThemesRepositoryEloquent'
        );

        $this->app->bind(
            'App\\Repositories\\TroopsRepository',
            'App\\Repositories\\TroopsRepositoryEloquent'
        );

        $this->app->bind(
            'App\\Repositories\\UsersRepository',
            'App\\Repositories\\UsersRepositoryEloquent'
        );
    }
}
