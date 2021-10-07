<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Usuarios  extends Model implements AuthenticatableContract, AuthorizableContract
{
    use HasApiTokens, Authenticatable, Authorizable, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * Atributos de Usuario editaveis
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'email', 'admin', 'password', 'ativo'
    ];

    /**
     * Atributos Ocultos
     *
     * @var array
     */
    protected $hidden = [
        'last_logged_in', 'password', 'created_at', 'updated_at', 'deleted_at'
    ];


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\MailResetPasswordNotification($token));
    }
}
