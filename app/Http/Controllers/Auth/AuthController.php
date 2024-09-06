<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use function Pest\Laravel\json;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request = $request->only(['email', 'password']);
        if (!auth()->attempt($request)) return response()->json(['message' => 'Dados não conferem.'],401);
        $user = User::where('email',$request['email'])
            ->first();

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
                    'token' => auth()->user()->createToken($request['email'],['*'],$expiresAt)->plainTextToken,
                ],

            ]
        );
    }
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Até logo!'
        ]) ;
    }
}
