<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Status Language Lines
    |--------------------------------------------------------------------------
    */

    'title' => 'Lista de Status',
    'name' => 'Status',
    'columns' => [
        'name' => 'Nome',
        'ref_table' => 'Referente à',
        'ref_table_input' => 'Tabela de Referência',
        'enable' => 'Habilitado',
        'status' => 'Status',
        'status_input' => 'Estado do Status',
        'created_at' => 'Criado em',
    ],
    'validate' => [
        'name' => 'Nome é Obrigatório!',
        'ref_table' => 'A Tabela de Referência é Obrigatória',
    ],
    'status_error' => 'Essa tabela de referência já possui um status :status',

];