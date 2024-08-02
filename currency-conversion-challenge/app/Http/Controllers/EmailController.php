<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use App\Models\Conversion;
use Illuminate\Support\Facades\Auth;

class EmailController extends Controller
{
    public function sendEmail($id)
    {
        $conversion = Conversion::findOrFail($id);

        $toEmail = Auth::user()->email;
        $message = $conversion;
        $subject = 'Assunto: Informações de Conversão de Moedas';

        Mail::to($toEmail)->send(new Email($message, $subject));

        return redirect()->back()->with('success', 'Email enviado com sucesso!');
    }
}
