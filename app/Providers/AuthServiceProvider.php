<?php

namespace App\Providers;

use App\Policies\TaskPolicy;
use App\Policies\UserPolicy;
use App\Task;
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
        Task::class => TaskPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('user:index', 'App\Policies\UserPolicy@viewAny');
        Gate::define('user:view', 'App\Policies\UserPolicy@create');
        Gate::define('user:delete', function (User $user) {
            return $user->roleIsAdmin();
        });
        Gate::define('user:update', function (User $user) {
            return $user->roleIsAdmin() || $user->roleIsUser();
        });
//        dd(Gate::abilities());
    }
}
