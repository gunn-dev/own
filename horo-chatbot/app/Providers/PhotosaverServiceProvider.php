<?php

namespace App\Providers;

use App\Helpers\Photosaver;
use Illuminate\Support\ServiceProvider;

class PhotosaverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('photosaver',function(){

            return new Photosaver();

        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
