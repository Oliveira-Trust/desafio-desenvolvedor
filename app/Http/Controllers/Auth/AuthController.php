<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function verifyEmail(Request $request) //from web route
    {
        auth()->loginUsingId($request->route('id')); //make login

        //test hash doesn't belong to the user
        if ($request->route('id') != $request->user()->getKey()) {
//            return response('Hash não pertence ao usuário', 401 );
            if (env('APP_DEBUG') === false){
                return redirect(env('APP_URL').'/login?verified=incorrect-user');
            }
            else{
                return redirect(env('APP_URL').':9000/login?verified=incorrect-user');
            }
        }

        //check if the email is already verified
        if ($request->user()->hasVerifiedEmail()) {
//            return response(['message'=>'Already verified']);
            if (env('APP_DEBUG') === false){
                return redirect(env('APP_URL').'/login?verified=old');
            }
            else{
                return redirect(env('APP_URL').':9000/login?verified=old');
            }
        }

        //mark as verified email
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
            if (env('APP_DEBUG') === false){
                return redirect(env('APP_URL').'/login?verified=ok');
            }
            else{
                return redirect(env('APP_URL').':9000/login?verified=ok');
            }
        }
        //nothing answers
        if (env('APP_DEBUG') === false){
            return redirect(env('APP_URL').'/login?verified=noting');
        }
        else{
            return redirect(env('APP_URL').':9000/login?verified=noting');
        }
    }

    public function resendVerifyEmail(Request $request)
    {
//        return response($request, 499);
//        return response(['message' => 'chegou aqui'], 499);
//        $request = $request->only('email');
//        return response($request, 499);
        $user = User::firstWhere('email', $request->email);
        $user->sendEmailVerificationNotification();
        return response(['message' => "Email de confirmação enviado para ".$request['email'] ]);
    }

    public function login(Request $request)
    {
//        return response()->json($request,499);
        $request = $request->only(['email', 'password']);
        if (!auth()->attempt($request)) abort(401, 'Dados não conferem');
        $user = User::where('email',$request['email'])
            ->first();

        if ($user->active != true) abort(401,'Usuário desativado');

        $resources = $user->role->resources;
        $resources = $resources->toArray();

        // Ordena o array pelo campo 'name'
        usort($resources, function($a, $b) {
            return strcmp($a['name'], $b['name']);
        });

        // Encontra o índice do objeto com 'name' igual a 'Dashboard'
        $dashboardIndex = array_search('Dashboard', array_column($resources, 'name'));

        // Move o objeto 'Dashboard' para a primeira posição
        if ($dashboardIndex !== false) {
            $dashboard = $resources[$dashboardIndex];
            unset($resources[$dashboardIndex]);
            array_unshift($resources, $dashboard);
        }

        if (!$user->email_verified_at) return response()->json([
            'message' =>  "Favor confirmar o e-mail $user->email!",
            'data' => [
                'user' => $user,
                'resources' => $resources,
            ],
        ]);

        if ($expirationMinutes = config('sanctum.expiration')) {
            $expirationMinutes = (int) $expirationMinutes;
            $expiresAt = Carbon::now()->addMinutes($expirationMinutes);
        } else {
            $expiresAt = null;
        }

        return response()->json([
                'message' =>  "Bem vindo(a) $user->name!",
                'data' => [
                    'user' => $user,
                    'resources' => $resources,
                    'token' => auth()->user()->createToken($request['email'],['*'],$expiresAt)->plainTextToken,
                ],

            ]
        );
    }
    public function logout(Request $request)
    {
//        return response()->json(['message' => "chegou"], 499);

//        $this->guard->logout();
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Até logo!'
        ]) ;
    }
}
