<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Exception;
use Illuminate\Http\Request;

class PasswordExpired {

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     * @throws Exception
     */
    public function handle(Request $request, Closure $next) {
        $user = $request->user();

        if ($user->password_expiry_login) {
            return redirect()->route('password.expired.edit');
        }

        if ($user->password_expiry_days !== null) {

            if (Carbon::now()->diffInDays($user->password_updated_at ?? $user->created_at) >= $user->password_expiry_days) {
                return redirect()->route('password.expired.edit');

            }
        }


        return $next($request);
    }
}
