<?php

namespace App\Repositories;

use App\Models\HistoryConversion;
use Illuminate\Support\Facades\Auth;

class HistoryConversionRepository
{

    public function findById(int $id)
    {
       return HistoryConversion::first($id);
    }

    public function findAll()
    {
        return HistoryConversion::all();
    }

    public function findAllByUser(int $userId)
    {
        return HistoryConversion::where('user_id',$userId)->get();
    }

    public function create($historyConversion)
    {
        $historyConversion['user_id'] = Auth::user()->id;

        return HistoryConversion::create($historyConversion);
    }

}
