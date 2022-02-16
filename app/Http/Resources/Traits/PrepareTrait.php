<?php
namespace App\Http\Resources\Traits;

use Illuminate\Support\Str;

trait PrepareTrait
{
    public function prepare($metodo = null, ...$data)
    {
        $method = isset($metodo) ? "prepare".Str::ucfirst($metodo) : "prepare".Str::ucfirst(debug_backtrace()[1]['function']);
        return $this->$method($data);
    }
}
