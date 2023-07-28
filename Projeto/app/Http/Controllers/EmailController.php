
<?php
// app/Http/Controllers/EmailController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UseCases\SendEmailUseCase;
use Exception;

class EmailController extends Controller
{
    private $sendEmailUseCase;

    public function __construct(SendEmailUseCase $sendEmailUseCase)
    {
        $this->sendEmailUseCase = $sendEmailUseCase;
    }

    public function send(Request $request)
    {
        $quote = $request->get('quote'); // Obter a cotação do request

        try {
            $this->sendEmailUseCase->execute($quote, $request->user());
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        return response()->json(['success' => 'E-mail sent']);
    }
}
