<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;

// use Illuminate\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('created', function ($user) {
            return $user->admin;
        });
        Gate::define('updated', function ($user) {
            return $user->admin;
        });
        Gate::define('deleted', function ($user, $news) {
            return $user->admin && $user->id === $news->user_id;
        });
    }
}
