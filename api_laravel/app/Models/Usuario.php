<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'email', 'password'];

    public function rules() 
    {
        return [
            'name' => 'required',
            'email' => 'required|unique|min:20',
            'password' => 'required|min:12|max:40'
        ];
    }

    public function messages() 
    {
        return [
           'required' => 'O campo :attribute é obrigatório',
           'unique' => 'Esse :attribute já existe',
           'password.min' => 'O campo :attribute deve ter no minímo 12 caracteres',
           'password.max' => 'O campo :attribute deve ter no máximo 40 caracteres',

        ];
    }

}
