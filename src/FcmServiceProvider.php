<?php

namespace MuhBayu\Fcm;

use Illuminate\Support\ServiceProvider;

class FcmServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
      require_once(__DIR__.'/Fcm.php');
      require_once(__DIR__.'/Helper.php');
    }
}
