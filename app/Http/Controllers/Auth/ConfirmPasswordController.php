<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    use ConfirmsPasswords;

    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function changePass(){
        return view('admin.trocarSenha');
    }

    public function updChangePass(Request $request){
        $regras = [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
        $mensagem =[
            'confirmed' => "A senha esta diferente da confirmação.",
            'required' => 'Este campo é obrigatório',
            'min' => 'O campo deve conter no mínimo 8 caracteres',
        ];
        
        $request->validate($regras,$mensagem);
        $data = $request->all();

        if(Auth::attempt(['email'=>Auth::user()->email,'password'=>$data['senhaatual']])){
            $data['password'] = bcrypt($data['password']);

            $update = auth()->user()->update($data);

            if($update){
                //return view('admin.trocarSenha')->with('alerta','Senha alterada com sucesso')->with('tipoalerta','success');
                return redirect()->route('admin.trocarSenha')->with('alerta','Senha alterada com sucesso')->with('tipoalerta','success');
            }
        }else{
            //return view('admin.trocarSenha')->withErrors(['senhaatual'=>'A senha atual está incorreta']);
            return redirect()->route('admin.trocarSenha')->withErrors(['senhaatual'=>'A senha atual está incorreta']);
        }
    }
}
