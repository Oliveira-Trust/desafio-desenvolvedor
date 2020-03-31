<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\App;

class CheckContentBodyJson
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if ( $request->isJson() ) {
            $action = $request->route()->getAction()['as'];
            if( !empty( $action ) ) {
                $json = $request->getContent();
                if( !empty( $json ) ) {
                    $action = ucfirst(camel_case(str_replace(['api.','.'], ['','_'], $action)));
                    $instacia = App::make('\App\MyClass\Json\\' . $action);
                    if (!empty($json)) {
                        $instacia->set($json);
                    }
                }
                return $next($request);
            }
        }
        return msgErroJson('Falha nos parametros!');
    }
}
