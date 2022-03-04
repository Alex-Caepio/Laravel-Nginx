<?php

namespace App\Providers;

use App\Http\Requests\UpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;
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

        Passport::routes();

        Gate::define('auth-user', function(UpdateRequest $request)
        {
            $id = Auth::id();
            return $id === $request->id;
        });

    }
}
