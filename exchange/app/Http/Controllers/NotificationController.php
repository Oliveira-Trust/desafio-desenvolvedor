<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $message = json_decode($request->getContent(), true)['Message'];  
        $to = json_decode($message, true)['token'];
        $data = array();
        $data['type'] = 'publish';
        $data['content'] = $message;
        $data['to'] = $to;
        Http::post('http://notification:2121', $data);
    }
}
