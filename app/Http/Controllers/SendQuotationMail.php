<?php

namespace App\Http\Controllers;

use App\Mail\QuotationRequested;
use App\Models\Conversion;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Mail;

class SendQuotationMail extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $conversionId)
    {
        $conversion = Conversion::with('paymentMethod')->findOrFail($conversionId);

        Mail::to($request->user())->send(new QuotationRequested($conversion));

        return redirect()->back()->with('success-message', 'Cotação enviada com sucesso!');
    }
}
