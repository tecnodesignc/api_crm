<?php

namespace Modules\Projects\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Projects\Events\Handlers\RegisterProjectsSidebar;

class ProjectsServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterProjectsSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('projects', Arr::dot(trans('projects::projects')));
            $event->load('objects', Arr::dot(trans('projects::objects')));
            $event->load('activities', Arr::dot(trans('projects::activities')));
            $event->load('tasks', Arr::dot(trans('projects::tasks')));
            // append translations




        });
    }

    public function boot()
    {
        $this->publishConfig('projects', 'permissions');

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
            'Modules\Projects\Repositories\ProjectRepository',
            function () {
                $repository = new \Modules\Projects\Repositories\Eloquent\EloquentProjectRepository(new \Modules\Projects\Entities\Project());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Projects\Repositories\Cache\CacheProjectDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Projects\Repositories\ObjectRepository',
            function () {
                $repository = new \Modules\Projects\Repositories\Eloquent\EloquentObjectRepository(new \Modules\Projects\Entities\Object());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Projects\Repositories\Cache\CacheObjectDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Projects\Repositories\ActivityRepository',
            function () {
                $repository = new \Modules\Projects\Repositories\Eloquent\EloquentActivityRepository(new \Modules\Projects\Entities\Activity());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Projects\Repositories\Cache\CacheActivityDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Projects\Repositories\TaskRepository',
            function () {
                $repository = new \Modules\Projects\Repositories\Eloquent\EloquentTaskRepository(new \Modules\Projects\Entities\Task());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Projects\Repositories\Cache\CacheTaskDecorator($repository);
            }
        );
// add bindings




    }
}
