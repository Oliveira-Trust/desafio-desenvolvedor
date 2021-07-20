<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin',
        'name',
        'email',
        'password',
        'enable',
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


    
	/**
     * relationships
     *
     * @return void
     */
	public function client() { return $this->hasOne(Client::class); }


    

    /* 
        Mutators
    */
    public function setNameAttribute($value){
        $this->attributes['name'] = ucfirst($value);
    }
   /*  //dd(request()->method(), $value);
    public function setPasswordAttribute($value){
        if((!empty($value) && request()->method() == 'POST') || !empty($value) && !is_null($value) || (request()->method() == 'PATCH' || request()->method() == 'PUT') ){
            $this->attributes['password'] = bcrypt($value);
        } else if(empty($value) || is_null($value)) {
            
        }
    } */

}
