<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Exibe o dashboard com estatísticas e uploads recentes.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $uploadStats = [
            'total' => Upload::count(),
            'completed' => Upload::where('status', 'completed')->count(),
            'failed' => Upload::where('status', 'failed')->count(),
            'pending' => Upload::whereIn('status', ['pending', 'processing'])->count(),
        ];
        
        $recentUploads = Upload::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('dashboard', [
            'uploadStats' => $uploadStats,
            'recentUploads' => $recentUploads,
        ]);
    }
} 