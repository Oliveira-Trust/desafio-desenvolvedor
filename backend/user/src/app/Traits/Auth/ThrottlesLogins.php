<?php

namespace App\Traits\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

trait ThrottlesLogins {
    /**
     * Determine if the user has too many failed login attempts.
     */
    protected function hasTooManyLoginAttempts(Request $request):bool {
        return $this->limiter()->tooManyAttempts($this->throttleKey($request), $this->maxAttempts());
    }

    /**
     * Increment the login attempts for the user.
     */
    protected function incrementLoginAttempts(Request $request) {
        $this->limiter()->hit($this->throttleKey($request), $this->decayMinutes() * 60);
    }

    /**
     * Redirect the user after determining they are locked out.
     * @throws TooManyRequestsHttpException
     */
    protected function sendLockoutResponse(Request $request) {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );
        throw new TooManyRequestsHttpException($seconds, Lang::get('auth.throttle', ['seconds' => $seconds, 'minutes' => ceil($seconds / 60),]));
    }

    /**
     * Clear the login locks for the given user credentials.
     */
    protected function clearLoginAttempts(Request $request) {
        $this->limiter()->clear($this->throttleKey($request));
    }

    /**
     * Fire an event when a lockout occurs.
     */
    protected function fireLockoutEvent(Request $request) {
        event(new Lockout($request));
    }

    /**
     * Get the throttle key for the given request.
     */
    protected function throttleKey(Request $request):string {
        return $request->ip();
    }

    /**
     * Get the rate limiter instance.
     */
    protected function limiter():RateLimiter {
        return app(RateLimiter::class);
    }

    /**
     * Get the maximum number of attempts to allow.
     */
    public function maxAttempts():int {
        return property_exists($this, 'maxAttempts') ? $this->maxAttempts : 3;
    }

    /**
     * Get the number of minutes to throttle for.
     */
    public function decayMinutes():int {
        return property_exists($this, 'decayMinutes') ? $this->decayMinutes : 1;
    }
}
