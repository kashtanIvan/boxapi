<?php

namespace Kashtanivan\Box;

use Illuminate\Support\ServiceProvider;

class BoxAPIServiceProviderLaravel4 extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('kashtanivan/boxapi');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app['config']->package('kashtanivan/boxapi', app_path().'/config/packages/kashtanivan/boxapi/');

        // create appuser
        $app['boxappuser'] = $app->share(function ($app) {
            return new BoxAppUser( $app['config']->get('boxapi::config') );
        });

        $app->alias('boxappuser', 'Kashtanivan\Box\BoxAppUser');
    }
}
