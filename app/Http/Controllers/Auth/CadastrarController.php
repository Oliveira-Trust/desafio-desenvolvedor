<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Http\Models\EmpresaPlano;
use App\Http\Models\Empresa;
use App\Http\Models\Loja;
use App\Http\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CadastrarController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {
        $request->validate([
            'Empresa.razao_social' => ['required', 'string', 'max:255'],
            'Empresa.telefone' => ['required', 'string', 'max:11'],
            'Empresa.celular' => ['required', 'string', 'max:11'],
            'nome' => ['required', 'string', 'max:255'],
            'Empresa.telefone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], 
            'password_confirmation' => ['required', 'string', 'min:8'],
        ],
        [
            'Empresa.razao_social.required' => 'O campo nome da empresa é obrigatório',
            'Empresa.telefone.required' => 'O campo telefone é obrigatório',
            'body.required' => 'Blahblahblahlah',
        ]);
        //Objetos de Model
        $objEmpresaPlano = new EmpresaPlano();
        $objEmpresa = new Empresa();
        $objLoja = new Loja();
        $objUser = new User();
        //Variaveis 
        $empresaPlano = [];
        $empresa = [];
        $user = [];
        $loja = [];
        if(!empty($request->Empresa)){
            $empresa = $request->Empresa;
            $empresa = $objEmpresa->salvar($request->Empresa);
        }
        if(!empty($empresa['id'])){
            $user = [
                'empresa_id' => $empresa['id'],
                'is_admin' => 1,
                'nome' => $request->nome,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];
            $user = $objUser->salvar($user);
        }
        if(!empty($empresa['id']) && !empty($user['id'])){
            $loja = [
                'empresa_id' => $empresa['id'],
                'nome' => $empresa['razao_social'],
                'matriz' => '1',
                'razao_social' => $empresa['razao_social'],
                'nome_fantasia' => $empresa['razao_social'],
                'user_id' => $user['id'],
                'nome_usuario' => $user['nome'],
            ];
            $loja = $objLoja->salvar($loja);
        }
        if(!empty($empresa['id']) && !empty($user['id']) && !empty($loja['id'])){
            $empresaPlano = [
                'empresa_id' => $empresa['id'],
                'loja_id' => $loja['id'],
                'nome' => $empresa['razao_social'],
                'user_id' => $user['id'],
                'nome_usuario' => $user['nome'],
            ];
            $empresaPlano = $objEmpresaPlano->salvar($empresaPlano);
        }
        unset($objEmpresaPlano, $objEmpresa, $objLoja, $objUser);
        return redirect()->route('login') ->with('success','Usuário cadastrado com sucesso!');
    }
    
}
