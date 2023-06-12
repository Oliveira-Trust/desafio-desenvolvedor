<?php

namespace App\Repositories;

use App\Models\Cotation;

class CotationRepository
{
    public function getAllCotationsByUserId(int $userId)
    {
        return Cotation::where('user_id', $userId)->orderBy('id', 'desc')->get();
    }

    public function getCotationById(int $id)
    {
        return Cotation::findOrFail($id);
    }

    public function getAllCotations()
    {
        return Cotation::orderBy('id', 'desc')->get();
    }

    public function save(Cotation $cotation)
    {
        $cotation->save();
    }
}
