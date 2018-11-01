<?php

namespace Modules\Agrocont\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Agrocont\Events\Handlers\RegisterAgrocontSidebar;
use Modules\Agrocont\Http\Middleware\LandInMiddleware;

class AgrocontServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     * @var array
     */
    protected $middleware = [
        'land.in' => LandInMiddleware::class
    ];


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterAgrocontSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('lands', array_dot(trans('agrocont::lands')));
            $event->load('lots', array_dot(trans('agrocont::lots')));
            $event->load('crops', array_dot(trans('agrocont::crops')));
            $event->load('activities', array_dot(trans('agrocont::activities')));
            // append translations






        });
    }

    public function boot()
    {
        $this->publishConfig('agrocont', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Agrocont\Repositories\LandsRepository',
            function () {
                $repository = new \Modules\Agrocont\Repositories\Eloquent\EloquentLandsRepository(new \Modules\Agrocont\Entities\Land());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Agrocont\Repositories\Cache\CacheLandsDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Agrocont\Repositories\LotsRepository',
            function () {
                $repository = new \Modules\Agrocont\Repositories\Eloquent\EloquentLotsRepository(new \Modules\Agrocont\Entities\Lot());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Agrocont\Repositories\Cache\CacheLotsDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Agrocont\Repositories\CropsRepository',
            function () {
                $repository = new \Modules\Agrocont\Repositories\Eloquent\EloquentCropsRepository(new \Modules\Agrocont\Entities\Crops());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Agrocont\Repositories\Cache\CacheCropsDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Agrocont\Repositories\ActivitiesRepository',
            function () {
                $repository = new \Modules\Agrocont\Repositories\Eloquent\EloquentActivitiesRepository(new \Modules\Agrocont\Entities\Activities());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Agrocont\Repositories\Cache\CacheActivitiesDecorator($repository);
            }
        );
// add bindings






    }
}
