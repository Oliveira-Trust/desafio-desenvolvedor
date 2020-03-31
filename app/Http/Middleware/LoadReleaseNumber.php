<?php

namespace App\Http\Middleware;

use Closure;

class LoadReleaseNumber
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
        $sessionName = 'realeseName';
        $releaseName = $request->session()->get($sessionName);

        if ( empty($releaseName) ) {

            $value = 'não indentificado';
            $file  = base_path().'/release.txt';

            if( file_exists( $file ) ){
                $handle = fopen( $file , "r");
                if( !is_null( $handle ) ) {
                    $buffer = fgets($handle, 4096);
                    if( !empty( $buffer ) ) {
                        $value = trim( $buffer );
                        $request->session()->put( $sessionName, $value );
                    }
                }
            } else {
                $request->session()->put( $sessionName, $value);
            }
        } else {
            $value = $releaseName;
        }

        view()->share($sessionName, $value );
        view()->share("cdnVersionJSCSS", '?v='.( isProduction() ? only_number( $value ) : rand(1000,9999) ) );

        return $next($request);

    }
}
