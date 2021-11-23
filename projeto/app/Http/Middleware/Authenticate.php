<?php

namespace App\Http\Middleware;

use Closure;
use App\Business\AuthenticationBusiness;

class Authenticate
{
    /**
     * @var AuthenticationBusiness
     */
    protected $authenticationBusiness;

    public function __construct(AuthenticationBusiness $authenticationBusiness)
    {
        $this->authenticationBusiness = $authenticationBusiness;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->authenticationBusiness->isAuthenticated()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }

        return $next($request);
    }
}
