<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Usuario' => 'App\Policies\UsuariosPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // ADMIN    
        Gate::define('esAdmin', function ($user) {
            return $user->getRoles->first()->slug_rol == 'es-administrador';
        });
        // FARMACEUTICO
        Gate::define('esFarmaceutico', function ($user) {
            return $user->getRoles->first()->slug_rol == 'es-farmaceutico';
        });
        // REGISTRADO
        Gate::define('esRegistrado', function ($user) {
            return $user->getRoles->first()->slug_rol == 'es-registrado';
        });

      
    }
}
