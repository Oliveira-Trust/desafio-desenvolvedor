<?php

namespace App\Http\Controllers;

use App\MyClass\FactoryApis;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{
    public function auth( Request $request, FactoryApis $factoryApis ){

        $validator = Validator::make( $request->all() , [
            'login'    => 'required|min:4',
            'password' => 'required|min:4'
        ] );

        if ( !$validator->fails() ) {

            $return = $factoryApis->setRequest($request)->post('auth');

            if( !empty( $return ) ){

                $request->session()->put( 'userData', [
                    'id'    => $return['id'],
                    'email' => $return['email'],
                    'name'  => $return['name'],
                    'when'  => getDateNow(),
                ] );

                return msgSuccessJson('OK');
            }
            return msgErroJson( \Lang::get('auth.failed'), 401 );
        } else {
            return msgErroJson($validator->errors()->first(), 400);
        }

    }

    public function index(){
        return view('auth.index');
    }

    public function logoff(Request $request){
        $request->session()->flush();
        return redirect()->route('auth.index');
    }
}
