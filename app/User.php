<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
	
	public function exibir ()
    {
		$exibir = self::select();
		
		
		if(isset($_GET["pesquisar"])){
			
			if($_GET["nome"])
				$exibir->whereRaw("name like '%".$_GET["nome"]."%'");
			
			if($_GET["email"])
				$exibir->whereRaw("email like '%".$_GET["email"]."%'");
			
			
			
		}
		
		return $exibir->get ();
	}
}
