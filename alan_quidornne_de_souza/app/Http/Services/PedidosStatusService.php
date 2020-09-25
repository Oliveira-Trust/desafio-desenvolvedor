<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Models\PedidoStatus;

class PedidosStatusService
{
    public function __construct()
    {
    }

    public function obterTodos()
    {
        return PedidoStatus::all();
    }
}