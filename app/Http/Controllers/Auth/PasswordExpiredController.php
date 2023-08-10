<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordExpiredRequest;
use Illuminate\Http\Request;

class PasswordExpiredController extends Controller {

    public function edit(Request $request) {

        if ( ! $request->user()->canUpdatePasswordExpired()) {
            return redirect()->route('user::dashboard');
        }

        return view('site::auth.password_expired');

    }

    public function update(PasswordExpiredRequest $request) {

        $user                  = $request->user();
        $password_expiry_login = $user->password_expiry_login;

        if ( ! $user->canUpdatePasswordExpired()) {
            return redirect()->route('user::dashboard');
        }

        \DB::beginTransaction();

        $user->fill($request->only(['password']));
        //setando para nunca expirar se tive sido o primeiro login
        if ($password_expiry_login) {
            $user->password_expiry_login = false; //nunca expira

        }
        $user->password_updated_at = now();
        $user->save();

        if ($user->password_expiry_days) {
            //salvando a senha antiga na lista de senhas antigas
            $user->user_old_passwords()->create([
                'password' => $user->password
            ]);
        } else {
            $user->user_old_passwords()->delete();
        }



        \DB::commit();

        $this->successNotify('Senha atualizada com sucesso!');

        return $this->successRoute('user::dashboard', null, 'Senha atualizada com sucesso!');
    }
}
