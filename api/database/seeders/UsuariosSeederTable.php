<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuarios;
use Illuminate\Support\Facades\Hash;


class UsuariosSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seed = [
            'nome'=>'Administrador',
            'email'=>'admin@administrador.com.br',
            'admin'=>1,
            'ativo'=>1,
            'password'=>Hash::make("admin@123")
        ];
        $usuario = Usuarios::create($seed);
    }
}
