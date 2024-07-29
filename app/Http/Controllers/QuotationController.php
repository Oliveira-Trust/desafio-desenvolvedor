<?php

namespace App\Http\Controllers;

use App\Actions\CreateQuotationAction;
use App\Apis\AwesomeApi;
use App\Jobs\SendQuotationEmail;
use App\Models\PaymentMethod;
use App\Models\Quotation;
use App\Services\QuotationResponseService;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuotationController extends Controller
{
    public function __construct(
        public QuotationResponseService $quotationService
    )
    {}
    public function index(): Application|Factory|View|Response|ResponseFactory|JsonResponse
    {
        try{
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

        } catch (\Exception $exception) {
            return response($exception->getMessage(), 500);
        }

    }

    public function store(Request $request): RedirectResponse
    {
        $quotation = app(CreateQuotationAction::class)->execute($request);

        $user = auth()->user();

        SendQuotationEmail::dispatch($user, $quotation);

        return redirect()->route('quotation.index')->with(['quotationResult' => $quotation]);
    }
}
