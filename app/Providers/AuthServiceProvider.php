<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-user', function (User $user) {
            return $user->role === 'admin';
        });
        Gate::define('register-member', function (User $user) {
            return $user->role === 'admin' || $user->role === 'kasir';
        });
        Gate::define('manage-laporan', function (User $user) {
            return $user->role === 'admin' || $user->role === 'owner';
        });
    }
}
