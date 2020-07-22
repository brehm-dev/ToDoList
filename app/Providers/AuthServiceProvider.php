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
        User::class => UserPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
//        Auth::viaRequest('');
        Gate::define('user:index', 'App\Policies\UserPolicy@viewAny');
        Gate::define('user:create', 'App\Policies\UserPolicy@create');
//        Gate::define('view-user', 'App\Policies\UserPolicy@view');
//        if (Gate::forUser($user)->allows('view-user', $user)) {
//            dd($user);
//        }
        Gate::define('user-view-user', function (User $user) {
            return $user->roleIsUser();
        });
//        Gate::define('user:delete', function (User $user) {
//            return $user->roleIsAdmin();
//        });
//        Gate::define('user:update', function (User $user) {
//            return $user->roleIsAdmin() || $user->roleIsUser();
//        });
//        dd(Gate::abilities());
    }
}
