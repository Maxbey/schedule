<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
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
            'SpecialtyService',
            'App\Services\SpecialtyService'
        );

        $this->app->bind(
            'TroopService',
            'App\Services\TroopService'
        );

        $this->app->bind(
            'TeacherService',
            'App\Services\TeacherService'
        );

        $this->app->bind(
            'DisciplineService',
            'App\Services\DisciplineService'
        );

        $this->app->bind(
            'ThemeService',
            'App\Services\ThemeService'
        );

        $this->app->bind(
            'OccupationService',
            'App\Services\OccupationService'
        );

        $this->app->bind(
            'AudienceService',
            'App\Services\AudienceService'
        );

        $this->app->bind(
            'Schedule',
            'App\Schedule\Schedule'
        );
    }
}
