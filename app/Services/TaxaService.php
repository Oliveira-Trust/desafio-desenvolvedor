<?php

namespace App\Services;

use App\Models\Taxa;

class TaxaService
{
    public function getTaxa($valor)
    {
        $userId = auth()->user()->id;

        return Taxa::whereUserId($userId)
            ->get()
            ->sortBy('valor')
            ->where('valor', '<=', $valor)
            ->last()
            ->taxa;
    }
}
