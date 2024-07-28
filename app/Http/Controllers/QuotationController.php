<?php

namespace App\Http\Controllers;

use App\Actions\CreateQuotationAction;
use App\Apis\AwesomeApi;
use App\Models\PaymentMethod;
use App\Models\Quotation;
use App\Services\QuotationResponseService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function __construct(
        private readonly QuotationResponseService $quotationService
    )
    {}
    public function index(): View|Factory|Application
    {
        $apiQuotation = app(AwesomeApi::class)->getQuotation();

        $apiQuotation = $this->quotationService->convertToCollection($apiQuotation);

        $paymentMethods = PaymentMethod::all();

        $quotationHistory = Quotation::where('user_id', auth()->id())->get();

        $quotationResult = session('quotationResult') ?? session('quotationResult');

        return view('dashboard')->with([
            'apiQuotation' => $apiQuotation,
            'paymentMethods' => $paymentMethods,
            'quotationHistory' => $quotationHistory,
            'quotationResult' => $quotationResult
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $quotation = app(CreateQuotationAction::class)->execute($request);

        return redirect()->route('quotation.index')->with(['quotationResult' => $quotation]);
    }
}
