<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->bindRepositories();
        $this->bindServices();
        $this->bindMiddlewares();
        $this->bindSingletons();
        $this->bindControllers();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register project repositories
     *
     * @return void
     */
    protected function bindRepositories(): void
    {
        //
    }

    /**
     * Register project services
     *
     * @return void
     */
    protected function bindServices(): void
    {
        //
    }

    /**
     * Register controllers
     *
     * @return void
     */
    protected function bindControllers(): void
    {
        //
    }

    /**
     * Register project singletons
     *
     * @return void
     */
    protected function bindSingletons(): void
    {
        //
    }

    /**
     * Register custom middlewares
     *
     * @return void
     */
    protected function bindMiddlewares(): void
    {
        $this->registerValidators();
    }

    /**
     * Register custom validation middlewares
     *
     * @return void
     */
    protected function registerValidators(): void
    {
        //
    }
}
