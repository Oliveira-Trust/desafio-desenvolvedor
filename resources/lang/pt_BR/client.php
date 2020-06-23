<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Client Language Lines
    |--------------------------------------------------------------------------
    */

    'title' => 'Lista de Clientes',
    'name' => 'Cliente',
    'columns' => [
        'name' => 'Nome',
        'dob' => 'Data de Nascimento',
        'email' => 'Email',
        'address' => 'Endereço',
        'contact' => 'Contato',
        'status_id' => 'Status',
        'user_id' => 'Usuário',
        'created_at' => 'Criado em',
    ],
    'validate' => [
        'name' => 'Nome é Obrigatório!',
        'dob' => 'Data de Nascimento fora do Formato!',
        'email' => 'Email é Obrigatório!',
        'address' => 'Endereço é Obrigatório!',
        'contact' => 'Contato é Obrigatório!',
        'status_id' => 'Status é Obrigatório!',
        'user_id' => 'Usuário é Obrigatório!',
    ],
    'client_error' => 'Essa tabela de referência já possui um client :client',

];