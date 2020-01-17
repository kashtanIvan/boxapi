<?php

namespace Kashtanivan\Box;

use Illuminate\Support\ServiceProvider;

class BoxAPIServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Actual provider
     *
     * @var \Illuminate\Support\ServiceProvider
     */
    protected $provider;

    /**
     * Create a new service provider instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function __construct($app)
    {
        parent::__construct($app);
        $this->provider = $this->getProvider();
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        return $this->provider->boot();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        return $this->provider->register();
    }

    /**
     * Return ServiceProvider according to Laravel version
     *
     * @return \Kashtanivan\Box\Provider\ProviderInterface
     */
    private function getProvider()
    {
        if ($this->app instanceof \Laravel\Lumen\Application) {
            $provider = '\Kashtanivan\Box\BoxAPIServiceProviderLumen';
        } elseif (version_compare(\Illuminate\Foundation\Application::VERSION, '5.0', '<')) {
            $provider = '\Kashtanivan\Box\BoxAPIServiceProviderLaravel4';
        } else {
            $provider = '\Kashtanivan\Box\BoxAPIServiceProviderLaravel5';
        }
        return new $provider($this->app);
    }

}
