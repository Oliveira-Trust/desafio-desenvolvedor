<?php

namespace App\Http\Middleware;

use App\Repositories\Contracts\TenantRepository;
use Closure;
use Illuminate\Support\Facades\Auth;

class KeycloackMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $tenantRepository = app(TenantRepository::class);

        $token = $request->bearerToken();

        $payload = $this->decodeToken($token);

        if(!$payload)
            return response('Unauthorized.', 401);

        $tenant = $tenantRepository->getTenant($payload->subdomain);

        if(!$tenant)
            return response('Unauthorized.', 401);

        return $next($request);
    }

    /**
     * Decode token JWT keycloack
     *
     * @param string $token
     * @return object|null
     */
    private function decodeToken(string $token) :? object
    {
        $tokenParts = explode(".", $token);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtPayload = json_decode($tokenPayload);

        return $this->getPayload($jwtPayload);
    }

    /**
     * Get payload token Keycloak.
     *
     * @param object $payload
     * @return object|null
     */
    private function getPayload(object $payload) :? object
    {
        if(!$payload->subdomain) return null;

        return $payload;
    }
}
