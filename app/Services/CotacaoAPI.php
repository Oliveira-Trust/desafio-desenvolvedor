<?php

namespace App\Services;

interface CotacaoAPI
{
    public function cotar(string $moeda_origem, string $moeda_destino);
}
