<?php

namespace App\Auth;

use App\Core\Http\Controllers\Controller;
use App\Core\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Inertia\Inertia;
use function redirect;
use function session;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(RouteServiceProvider::HOME)
                    : Inertia::render('Auth/VerifyEmail', ['status' => session('status')]);
    }
}
