<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * Enviar
     */
    public function sendEmail(Request $request){
        try {
            $data = $request->all();

            $user = Auth::user();
            Mail::send('email.email', ['data' => $data], function ($message) use ($user) {
                $message->from(env('MAIL_FROM_ADDRESS', 'thainan.cpv76@gmail.com'))
                    ->to($user->email)
                    ->subject('Conversão de Moeda');
            });

            $success = true;
            $message = "E-mail enviado com sucesso!";
        } catch (\Exception $e) {
            $success = false;
            $message = $e->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];

        return response()->json($response);
    }

}
