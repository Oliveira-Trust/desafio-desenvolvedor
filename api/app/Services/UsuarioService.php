<?php 
namespace App\Services;

use App\Http\Requests\Login;
use App\Http\Requests\Registro;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Contracts\Service\ServiceProviderInterface;

class UsuarioService  {   

        public function __construct(private User $usuario) {}

        public function registrar(Registro $registro)
        {
            $usuario = $this->usuario::create([
                'email' => $registro->email,
                'nome' => $registro->nome,
                'password' => $registro->password
            ]);

            return [
                'token' => $usuario->createToken([ 'app-laravel-id', ['*'], now()->addWeek()  ])->plainTextToken
            ];
        }

        public function token(Login $login)
        {
                $usuario  = $this->usuario::where('email',  $login->email)->first();
                if (!$usuario || !Hash::check($login->password,  $usuario->password)) {
                    throw ValidationException::withMessages([
                        'email' => ['As credenciais informadas estão incorretas!']
                    ]);
                }
        }

}