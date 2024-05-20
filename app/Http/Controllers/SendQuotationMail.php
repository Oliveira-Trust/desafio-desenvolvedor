<?php

namespace App\Http\Controllers;

use App\Mail\QuotationRequested;
use App\Models\Conversion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendQuotationMail extends Controller
{
    public function __invoke(Request $request, int $conversionId)
    {
        $conversion = Conversion::with('paymentMethod')->findOrFail($conversionId);

        Mail::to($request->user())->send(new QuotationRequested($conversion));

        return redirect()->back()->with('success-message', 'Cotação enviada com sucesso!');
    }
}
