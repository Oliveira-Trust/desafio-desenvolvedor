<?php

namespace App\Providers;

use App\Models\User;
use App\Repositories\Contracts\TenantRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.
        $this->app['auth']->viaRequest('keycloak', function ($request) {
            if (!$request->hasHeader('Authorization')) {
                return null;
            }

            $token = $request->bearerToken();
            $tokenParts = explode(".", $token);
            $tokenPayload = base64_decode($tokenParts[1]);
            $jwtPayload = json_decode($tokenPayload);
            $tenantRepository = app(TenantRepository::class);

            return $tenantRepository->getTenant($jwtPayload->subdomain);
        });
    }
}
