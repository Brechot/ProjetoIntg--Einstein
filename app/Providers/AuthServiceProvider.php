<?php

namespace App\Providers;

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
//        $this->registerPolicies();

        Gate::define('role', function ($user, ...$roles) {
            // Padroniza tudo pra lowercase
            $userRole = strtolower($user->role->title);
            $expectedRoles = array_map('strtolower', $roles);

            return in_array($userRole, $expectedRoles);
        });
    }
}
