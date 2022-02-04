<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class MailController extends Controller
{
    public function sendEmail()
    {
        $details = [
            'title' => 'Mail of naelson',
            'body' => 'this is for  testing using email'
        ];
        Mail::to("naelson.g.saraiva@gmail.com")->send(new TestMail($details));
        return 'Mail sent';
    }
}
