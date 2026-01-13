<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadHistoryController extends Controller
{
    public function index(Request $request)
    {
        $indexPath = storage_path('app/private/uploads/index.json');

        if (!file_exists($indexPath) || trim(file_get_contents($indexPath)) === '') {
            return response()->json([
                'data' => [],
                'total' => 0,
            ]);
        }

        $history = json_decode(file_get_contents($indexPath), true);
        if (!is_array($history)) {
            $history = [];
        }

        $filename = $request->query('filename'); // filtro opcional
        $date = $request->query('date'); // YYYY-MM-DD, filtro opcional

        if ($filename) {
            $history = array_values(array_filter($history, function ($item) use ($filename) {
                return isset($item['original_name']) && stripos($item['original_name'], $filename) !== false;
            }));
        }

        if ($date) {
            $history = array_values(array_filter($history, function ($item) use ($date) {
                return isset($item['uploaded_at']) && str_starts_with($item['uploaded_at'], $date);
            }));
        }

        usort($history, fn ($a, $b) => strcmp($b['uploaded_at'] ?? '', $a['uploaded_at'] ?? ''));

        return response()->json([
            'data' => $history,
            'total' => count($history),
        ]);
    }
}
