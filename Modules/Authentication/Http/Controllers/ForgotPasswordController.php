<?php

namespace Modules\Authentication\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function forgot(Request $request)
    {
        $credentials = $request->validate(['email' => 'required|email']);

        try {
            $status = Password::sendResetLink($credentials);

            if ($status === Password::RESET_LINK_SENT) {
                return response([
                    'status' => __($status),
                ], JsonResponse::HTTP_OK);
            } else {
                return response([
                    'email' => __($status),
                ], JsonResponse::HTTP_BAD_REQUEST);
            }

        } catch (\Throwable $th) {
            $th;
        }

    }
}
