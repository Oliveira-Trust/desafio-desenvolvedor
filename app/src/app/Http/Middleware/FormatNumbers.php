<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FormatNumbers
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
        $request->merge($this->removeCommasAndSetDotAsDecimalPlace($request));

        return $next($request);
    }

    private function removeCommasAndSetDotAsDecimalPlace(Request $request): array
    {
        return collect($request->all())->map(function ($value, $key) {
            if (is_string($value) && strpos($value, ',') !== false && preg_match('/^\d+([,.]\d+)*$/', $value)) {
                return str_replace(',', '.', str_replace('.', '', $value));
            }

            return $value;
        })->all();
    }
}
