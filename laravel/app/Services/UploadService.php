<?php

namespace App\Services;

use App\Models\Upload;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class UploadService
{
    public function list(Request $request): LengthAwarePaginator
    {
        $query = Upload::query()->orderByDesc('created_at');

        if ($filename = $request->query('filename')) {
            $query->where('original_name', 'like', "%{$filename}%");
        }

        if ($date = $request->query('date')) {
            $query->whereDate('reference_date', $date);
        }

        return $query->paginate(15);
    }
}
