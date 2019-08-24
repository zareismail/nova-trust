<?php

namespace NovaTrust;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use NovaTrust\Http\Middleware\Authorize;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Authenticatable;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/nova-trust.php', 'nova-trust');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'nova-trust');
        $this->loadJsonTranslationsFrom(__DIR__.'/../resources/lang');

        $this->app->booted(function () { 
            $this->laratrustConfigurations();   
        });

        if($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

            $this->registerPublishing();
        }
    } 

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    { 
        Nova::serving(function (ServingNova $event) {
            $this->registerPolicies();
            $this->registerResources();
        });
    }

    public function registerResources()
    { 
        Nova::resources([
            Resources\Role::class,
            Resources\Team::class,
            Resources\Permission::class,
        ]);
    }

    public function registerPolicies()
    { 
        Gate::policy(Role::class, Policies\RolePolicy::class); 
        Gate::policy(Team::class, Policies\TeamPolicy::class); 
        Gate::policy(Permission::class, Policies\PermissionPolicy::class); 

        Gate::before(function($user, $ability) { 
            return call_user_func_array([Helpers\Checker::class, 'check'], func_get_args());
        });
    }  

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
    { 
        $this->publishes([
            __DIR__.'/../config/nova-trust.php' => config_path('nova-trust.php'),
        ], ['nova-trust', 'nova-trust-config']); 

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/nova-trust'),
        ], ['nova-trust', 'nova-trust-lang']);

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/nova-trust'),
        ], ['nova-trust', 'nova-trust-views']);

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], ['nova-trust', 'nova-trust-migrations']);
    }

    public function laratrustConfigurations()
    {
        \Config::set('laratrust.user_models', $this->userModels());  
        \Config::set('laratrust.use_teams', true);
        \Config::set(
            'laratrust.teams_strict_check', config('nova-trust.teams_strict_check', true)
        );
        \Config::set('laratrust.models', [
            'role' => Role::class,
            'permission' => Permission::class,
            'team' => Team::class,
        ]); 
    }

    public function userModels()
    {
        $modelRetriver = function($resource, $user) {
            return [
                $user => $resource::$model
            ]; 
        };

        return collect(config('nova-trust.user_resources'))->mapWithKeys($modelRetriver)->all();
    }
}
