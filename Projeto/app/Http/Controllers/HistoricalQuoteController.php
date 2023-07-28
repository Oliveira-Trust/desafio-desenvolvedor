
<?php
// app/Http/Controllers/HistoricalQuoteController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\HistoricalQuoteRepositoryInterface;
use Exception;

class HistoricalQuoteController extends Controller
{
    private $historicalQuoteRepository;

    public function __construct(HistoricalQuoteRepositoryInterface $historicalQuoteRepository)
    {
        $this->historicalQuoteRepository = $historicalQuoteRepository;
    }

    public function show(Request $request)
    {
        $user = $request->user(); // Obter o usuário autenticado

        try {
            $quotes = $this->historicalQuoteRepository->getQuotesByUserId($user->id);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        return response()->json(['quotes' => $quotes]);
    }
}
