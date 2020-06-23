<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Client Language Lines
    |--------------------------------------------------------------------------
    */

    'title' => 'Lista de Ordens de Compra',
    'name' => 'Ordens de Compra',
    'columns' => [
        'products' => 'Total de Produtos',
        'total' => 'Total',
        'client_id' => 'Cliente',
        'user_id' => 'Usuário',
        'status_id' => 'Status',
        'created_at' => 'Criado em',
    ],
    'validate' => [
        'client_id' => 'Cliente é Obrigatório!',
        'status_id' => 'Status é Obrigatório!',
        'user_id' => 'Usuário é Obrigatório!',
        'products' => 'Você não pode fazer uma ordem sem Produtos!',
    ],
    'client_error' => 'Essa tabela de referência já possui um client :client',

];