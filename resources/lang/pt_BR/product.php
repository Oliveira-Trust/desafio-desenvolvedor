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
        'description' => 'Descrição',
        'image' => 'Imagem',
        'price' => 'Preço',
        'status_id' => 'Status',
        'user_id' => 'Usuário',
        'created_at' => 'Criado em',
    ],
    'validate' => [
        'name' => 'Nome é Obrigatório!',
        'description' => 'Descrição é Obrigatória!',
        'image' => 'Imagem é Obrigatória!',
        'price' => 'Preço é Obrigatório!',
        'status_id' => 'Status é Obrigatório!',
        'user_id' => 'Usuário é Obrigatório!',
    ],
    'client_error' => 'Essa tabela de referência já possui um client :client',

];