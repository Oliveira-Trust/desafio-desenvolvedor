<?php

namespace App\Http\Controllers;

use App\Services\ConversaoService;
use Exception;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

use function PHPUnit\Framework\throwException;

class MoedaController extends Controller
{
    /**
     * 
     * @return void
     */

    public function __construct()
    {
    }

    public function converter(Request $req)
    {
        $de = $req->de;
        $para = $req->para;
        $service = new ConversaoService();
        return $service->converter($de, $para);
    }

    function enviarEmail(Request $req)
    {
        $data = $req->all();
        try {
            \Illuminate\Support\Facades\Mail::send('emails.test', $data, function (\Illuminate\Mail\Message $message) {
                $message->to(address: 'oliveiratrustchallenge@gmail.com', name: 'Test User')
                    ->from(address: 'nagatomatheus@gmail.com', name: 'MatheusOtTeste')
                    ->subject(subject: 'Test Mail');
            });
            return 'E-mail enviado com sucesso';
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
