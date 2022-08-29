<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.forgot-password');
    }

    public function handle(Request $request)
    {
        $this->validate(
            $request,
            ['email' => 'required|email|exists:users']
        );

        
        $sent = Password::sendResetLink(
            $request->only('email')
        );

        if ($sent === Password::RESET_LINK_SENT) {
            Notification::make()
                ->title('Link para redefinição de senha enviado!')
                ->body('Verifique seu email para continuar')
                ->duration(10000)
                ->success()
                ->send();
            return back();
        }

        return back()->withErrors(['email' => __($sent)]);
    }

    public function resetPasswordIndex(Request $request)
    {
        return view('auth.password-reset', ['token' => $request->token]);
    }

    public function resetPasswordHandle(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6|confirmed',
        ]);
     
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ]);
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            Notification::make()
                ->title('Senha redefinida com sucesso!')
                ->body('Insira suas credenciais para acessar o sistema.')
                ->duration(10000)
                ->success()
                ->send();
            return redirect()->route('auth.login.index');
        }
     
        return back()->withErrors(['email' => [__($status)]]);
    }
}
