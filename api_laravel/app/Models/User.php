<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    


    public function rules() 
    {
        return [
            'name' => 'required',
            'email' => 'email',
            'password' => 'required|min:5'
        ];
    }

   public function messagesInfo() 
   {
        return [
        
            'required' => 'O campo :attribute é obrigatório',
            'email' => 'Por favor preencher um email valido',
            'min' => 'O campo :attribute deve ter no minímo 6 caracteres'
           
        ];
   }

   public function historico() 
   {
      return $this->belongsToMany('App\Models\HistoricoCotacao', 'historico', 'user_id', 'id')->withPivot('id','created_at');
   }
 
}
