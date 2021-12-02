<?php

namespace Modules\Crm\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Crm\Events\Handlers\RegisterCrmSidebar;

class CrmServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterCrmSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('accounts', Arr::dot(trans('crm::accounts')));
            $event->load('contacts', Arr::dot(trans('crm::contacts')));
            $event->load('leads', Arr::dot(trans('crm::leads')));
            $event->load('activities', Arr::dot(trans('crm::activities')));
            // append translations




        });
    }

    public function boot()
    {
        $this->publishConfig('crm', 'permissions');

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
            'Modules\Crm\Repositories\AccountRepository',
            function () {
                $repository = new \Modules\Crm\Repositories\Eloquent\EloquentAccountRepository(new \Modules\Crm\Entities\Account());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Crm\Repositories\Cache\CacheAccountDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Crm\Repositories\ContactRepository',
            function () {
                $repository = new \Modules\Crm\Repositories\Eloquent\EloquentContactRepository(new \Modules\Crm\Entities\Contact());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Crm\Repositories\Cache\CacheContactDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Crm\Repositories\LeadRepository',
            function () {
                $repository = new \Modules\Crm\Repositories\Eloquent\EloquentLeadRepository(new \Modules\Crm\Entities\Lead());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Crm\Repositories\Cache\CacheLeadDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Crm\Repositories\ActivityRepository',
            function () {
                $repository = new \Modules\Crm\Repositories\Eloquent\EloquentActivityRepository(new \Modules\Crm\Entities\Activity());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Crm\Repositories\Cache\CacheActivityDecorator($repository);
            }
        );
// add bindings




    }
}
