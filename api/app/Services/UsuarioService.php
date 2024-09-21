<?php 
namespace App\Services;

use App\Http\Requests\Login;
use App\Http\Requests\Registro;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UsuarioService  {   

        public function __construct(private User $usuario) {}

        public function registrar(Registro $registro)
        {
            $usuario = $this->usuario::create([
                'email' => $registro->email,
                'nome' => $registro->nome,
                'password' => $registro->password
            ]);
            
            $token = $usuario->createToken('auth_token')->plainTextToken;
            return [
                'user' => $usuario,
                'token' => $token
            ];
        }

        public function token(Login $login)
        {
                $usuario  = $this->usuario::where('email',  $login->email)->first();

                if (!$usuario || !Hash::check($login->password,  $usuario->password)) {
                    throw ValidationException::withMessages([
                        'message' => ['As credenciais informadas estão incorretas!']
                    ]);
                }

                return $usuario->createToken('auth_token')->plainTextToken;
        }

}