<?php

namespace GTI\Attendance;

use Illuminate\Support\ServiceProvider;

class AttendanceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
        // $this->app->make('Illuminate\Database\Eloquent\Factory')->load(__DIR__ . '/database/factories');
    }
}
