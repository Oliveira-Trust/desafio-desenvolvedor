<?php

namespace App\Http\Controllers;

use App\Mail\SendMailUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    public function sendMail(Request $request){
        try {
            $mailable = new SendMailUser([ 'contact' => $request->input() ]);
            Mail::to($request->get('mail'))->send($mailable);
            $response['successMessage'] = 'Email enviado com sucesso.';
        } catch (\Exception $e){
            $response['errorMessage'] = 'Ocorreu um erro e o email não foi enviado. Tente novamente ou entre em contato com o administrador.';
        }

        return redirect()->route('index')->with($response)->withInput($request->all());
    }
}
