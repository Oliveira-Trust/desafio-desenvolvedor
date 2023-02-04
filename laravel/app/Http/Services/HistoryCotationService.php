<?php

namespace App\Http\Services;

use App\Models\HistoryCotation;

class HistoryCotationService
{
    public function getHistory()
    {
        return HistoryCotation::query()
            ->with('user')
            ->where('user_id', auth()->user()->id)
            ->orderByDesc('id')
            ->paginate(7);
    }

    public function findById(int $id)
    {
        return HistoryCotation::query()->find($id);
    }

}
