<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConversionEmail; 

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {       
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);
      
        Mail::to($request->input('email'))->send(new ConversionEmail($request->input('subject'), $request->input('message')));

        return response()->json(['success' => true, 'message' => 'E-mail enviado com sucesso!']);
    }
}
