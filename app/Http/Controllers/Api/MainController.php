<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Danganf\MyClass\LogDebug;
use Illuminate\Http\Request;

class MainController extends Controller
{
    private $pdvApi;

    public function __construct()
    {

    }

    public function auth( Request $request, UserRepository $userRepository ){

        $result = $userRepository->auth( $request->get('json')->get('login'), $request->get('json')->get('password') );
        if( !empty( $result ) ){
            return msgJson( $result );
        }
        return msgErroJson( \Lang::get('auth.failed'), 401 );

    }

    public function createLogError(Request $request, LogDebug $logDebug){
        $logDebug->setLogFile('JavaScript');
        $logDebug->error( '', $request->all() );
    }

    public function logoff(Request $request){
        $request->session()->flush();
        return redirect()->route('auth.index');
    }
}
