<?php

namespace App\Http\Controllers\Gerencial;

use App\Http\Controllers\Controller;
use App\Http\Models\EmpresaPlano;
use App\Http\Models\Empresa;
use App\Http\Models\User;
use App\Http\Models\Conta;
use App\Http\Models\Credencial;
use App\Http\Models\Loja;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Auth;
use Facade\FlareClient\Stacktrace\File;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @link https://laravel.com/docs/7.x/queries#where-clauses
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){}
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function atualizar(Request $request, $id)
    {
        $objUser =  new User();
        $usuario = $objUser->buscarPorId(Auth::user()->empresa_id, $id);
        if(empty( $usuario )){
            return redirect()->route('usuarios.index')
                    ->withInput()
                    ->withErrors([
                        'error' => 'Você não tem permissão para acessar esta área.',
                    ]);
        }
        $validaPassword = [];
        if(!empty($request->password)){
            $validaPassword = ['required', 'string', 'min:8'];
            $request->request->add(['password' => Hash::make($request->password)]);
        }else{
            $request->request->remove('password');
        }
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'password' =>  $validaPassword,  
        ]);
        if(empty($request->ativo)){
            $request->request->add(['ativo' => 'N']);
        }
        
        $usuario->atualizar($request->all());
        unset($objUser);
        return redirect()->route('usuarios.index')
                        ->with('success','Cliente atualizado com sucesso!');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function meusDados($id){
        $objUser =  new User();
        $usuario = $objUser->buscarPorId(Auth::user()->empresa_id, $id);
        if($id != Auth::user()->id ){
            return redirect()->route('home')
                    ->withInput()
                    ->withErrors([
                        'error' => 'Você não tem permissão para acessar esta área.',
                    ]);
        }
        $credenciaisUsuarios = $objUser->buscarPorEmpresaEPermissaoApi(Auth::user()->empresa_id);
        unset( $objUser);
        return view('gerencial.usuarios.meus_dados',compact('usuario','credenciaisUsuarios'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function atualizarMeusDados(Request $request, $id){
        $objUser =  new User();
        $usuario = $objUser->buscarPorId(Auth::user()->empresa_id, $id);
        if(empty( $usuario )){
            return redirect()->route('usuarios.index')
                    ->withInput()
                    ->withErrors([
                        'error' => 'Você não tem permissão para acessar esta área.',
                    ]);
        }
        $validaPassword = [];
        if(!empty($request->password)){
            $validaPassword = ['required', 'string', 'min:8'];
            $request->request->add(['password' => Hash::make($request->password)]);
        }else{
            $request->request->remove('password');
        }
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'password' =>  $validaPassword,  
        ]);
        $usuario->atualizar($request->all());
        unset($objUser);
        return redirect()->route('usuarios.meus_dados',Auth::user()->id)
                        ->with('success','Dados atualizados com sucesso!');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function atualizarFoto(Request $request, $id){
        $objUser =  new User();
        $usuario = $objUser->buscarPorId(Auth::user()->empresa_id, $id);
        if(empty( $usuario )){
            return redirect()->route('usuarios.index')
                    ->withInput()
                    ->withErrors([
                        'error' => 'Você não tem permissão para acessar esta área.',
                    ]);
        }
        $nomeArquivo = '';
        $arquivo = '';
        $pasta = '';
        $path = '';
        $ext = '';
        $pasta = '/upload/'.Auth::user()->empresa_id.'/avatar/'.$id.'/';
        $path = public_path($pasta);
        $file = $request->file('avatar');
        $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        $nomeArquivo = 'avatar_'.date('d_m_Y_h_i_s').'_'.Auth::user()->empresa_id.'_'.$id.'.'.$ext;
        $arquivo = $path.$nomeArquivo;
        $arquivosExcluir = [];
        if(is_dir($path)){
            $arquivosExcluir = \File::files($path);
        }
        if(!empty($arquivosExcluir)){
            foreach($arquivosExcluir as $k => $item){
                if(\File::exists($item->getPathName())){
                    \File::delete($item->getPathName());
                }
            }
        }
        $file->move($path,$nomeArquivo);
        $usuario->foto = $pasta.$nomeArquivo;
        $usuario->save();
        unset($objUser);
        return response()->json([
            'ok' => true,
        ]);
    }
}
