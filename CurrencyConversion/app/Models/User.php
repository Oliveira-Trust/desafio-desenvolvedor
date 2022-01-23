<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    

    protected   $table          = 'adm_usr_users';
    protected   $dateFormat     = 'd/m/Y H:i:s';
    protected   $primaryKey     = 'id';



    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'status',
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
    protected $casts = [ 'email_verified_at' => 'datetime'];

    public function CurrencyConversion()
    {
        return $this->hasMany('App\Models\CurrencyConversion', 'usu_id');
    }

    static function  RoleList() {
        return \Spatie\Permission\Models\Role::pluck('name','id')->all();
    }




    
}