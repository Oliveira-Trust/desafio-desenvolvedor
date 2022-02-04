<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

// class User extends Authenticatable
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'empresa_id',
        'nome', 
        'cpf', 
        'valor_unidade_bet_365', 
        'email', 
        'password', 
        'is_admin',
        'tipo',
        'ativo',
        'permissao_api',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * Lista paginacao
     *
     * @param array $condicoes
     * @return void
     */
    public function listaPaginacao($condicoes = []){
        $usuarios = [];
        $usuarios = $this
                    ->where( $condicoes )
                    ->select( 'users.id', 'users.nome' ,'users.email')
                    ->paginate(5);
        return $usuarios;
    }
    /**
     * Salvar
     *
     * @param [type] $dados
     * @return void
     */
    public function salvar($dados){
        $user = [];
        $user = $this->create($dados);
        return $user;
    }
    /**
     * Atualizar
     *
     * @param [type] $dados
     * @return void
     */
    public function atualizar($dados){
        $usuario = [];
        $usuario = $this->update($dados);
        // dd($usuario);
        return $usuario;
    }
    /**
     * Buscar Por ID
     *
     * @param [type] $dados
     * @return void
     */
    public function buscarPorId($empresa_id, $id){
        $usuario = [];
        $usuario = $this->select($this->fillable)
                        ->where([
                            ['id','=',  $id]
                        ])->first();
        return $usuario;
    }
    /**
     * Buscar Por ID
     *
     * @param [type] $dados
     * @return void
     */
    public function buscarPorEmpresaIdEId($empresa_id, $id){
        $usuario = [];
        $usuario = $this->select($this->fillable)
                        ->where([
                            ['empresa_id','=',  $empresa_id],
                            ['id','=',  $id]
                        ])->first();
        return $usuario;
    }
    /**
     * Buscar Por permissao api
     *
     * @param [type] $dados
     * @return void
     */
    public function buscarPorEmpresaEPermissaoApi($empresa_id, $permissao_api = 1){
        $usuario = [];
        $usuario = $this->select($this->fillable)
                        ->where([
                            ['empresa_id','=',  $empresa_id],
                            ['permissao_api','=', $permissao_api]
                        ])->get();
        // dd($usuario);
        return $usuario;
    }
    /**
     * Buscar Por Empresa
     *
     * @param [type] $dados
     * @return void
     */
    public function buscarPorEmpresa($empresa_id){
        $usuario = [];
        $usuario = $this->select($this->fillable)
                        ->where([
                            ['empresa_id','=',  $empresa_id]
                        ])->get();
        // dd($usuario);
        return $usuario;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier(){
        return $this->getKey();
    }
    
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(){
        return [];
    }
}