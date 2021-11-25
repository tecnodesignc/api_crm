<?php

namespace Modules\History\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Core\Traits\CanGetSidebarClassForModule;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\History\Composers\HistoryViewComposer;
use Modules\History\Entities\History;
use Modules\History\Events\Handlers\RegisterHistorySidebar;
use Modules\History\Repositories\Cache\CacheHistoryDecorator;
use Modules\History\Repositories\Eloquent\EloquentHistoryRepository;
use Modules\History\Repositories\HistoryRepository;
use Modules\History\Services\EncoreHistory;
use Modules\User\Contracts\Authentication;
use Illuminate\Support\Arr;

class HistoryServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration, CanGetSidebarClassForModule;
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
        $this->registerViewComposers();

        $this->app['events']->listen(BuildingSidebar::class,
            $this->getSidebarClassForModule('history', RegisterHistorySidebar::class)
        );
        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('messages', Arr::dot(trans('history::messages')));
        });
    }

    public function boot()
    {
        $this->publishConfig('history', 'config');
        $this->publishConfig('history', 'permissions');
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
            HistoryRepository::class,
            function () {
                $repository = new EloquentHistoryRepository(new History());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new CacheHistoryDecorator($repository);
            }
        );

        $this->app->bind(\Modules\History\Services\History::class, function ($app) {
            return new EncoreHistory($app[HistoryRepository::class], $app[Authentication::class]);
        });
    }

    private function registerViewComposers()
    {
        view()->composer('partials.top-nav', HistoryViewComposer::class);
    }
}
