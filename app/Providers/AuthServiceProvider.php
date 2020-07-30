<?php

namespace App\Providers;

use App\Policies\SchedulePolicy;
use App\Policies\UserPolicy;
use App\Schedule;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Schedule::class => SchedulePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('index-user', 'App\Policies\UserPolicy@viewAny');
        Gate::define('view-user', 'App\Policies\UserPolicy@view');
        Gate::define('create-user', 'App\Policies\UserPolicy@create');
        Gate::define('update-user', 'App\Policies\UserPolicy@update');
        Gate::define('delete-user', 'App\Policies\UserPolicy@delete');

        Gate::define('index-schedule', 'App\Policies\SchedulePolicy@viewAny');
        Gate::define('view-schedule', 'App\Policies\SchedulePolicy@view');
        Gate::define('create-schedule', 'App\Policies\SchedulePolicy@create');
        Gate::define('update-schedule', 'App\Policies\SchedulePolicy@update');
        Gate::define('delete-schedule', 'App\Policies\SchedulePolicy@delete');

    }
}
