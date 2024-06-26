<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
<<<<<<< HEAD
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
=======
        //
>>>>>>> b63bbc5 (useCase(creerPartie,effectuerPartie))
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
<<<<<<< HEAD
        $this->registerPolicies();

=======
>>>>>>> b63bbc5 (useCase(creerPartie,effectuerPartie))
        //
    }
}
