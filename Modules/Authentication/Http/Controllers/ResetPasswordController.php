<?php

namespace Modules\Authentication\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;


class ResetPasswordController extends Controller
{
    public function formReset(Request $request)
    {
        // return view to form
    }

    public function reset(Request $request)
    {
        $validate = validator($request->all(), [
            'token'    => 'required|string',
            'email'    => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validate->fails()) {
            return response(['errors'=> $validate->getMessageBag()], 422);
        }

        try {
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) use ($request) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->save();

                    $user->setRememberToken(Str::random(60));

                    event(new PasswordReset($user));
                }
            );

            if ($status == Password::PASSWORD_RESET) {
                return response([
                    'status' => __($status),
                ], JsonResponse::HTTP_OK);
            } else {
                return response([
                    'email' => __($status),
                ], JsonResponse::HTTP_BAD_REQUEST);
            }

        } catch (\Throwable $th) {
            throw $th;
        }




    }
}
