<?php

namespace App\Http\Controllers\Web;

use App\Models\Quote;
use App\Services\QuoteService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Exceptions\PermissionDaniedException;
use App\Http\Requests\QuoteRequest as Request;

class QuoteController extends Controller
{
    use ManualPaginator;

    /**
     * @var QuoteService $quoteService
     */
    private $quoteService;

    /**
     * @param QuoteService $quoteService
     */
    public function __construct(QuoteService $quoteService)
    {
        $this->quoteService = $quoteService;
    }

    /**
     * @return Illuminate\Support\Facades\View;
     */
    public function formQuote()
    {
        return view('dashboard.quotes.quote');
    } 

    /**
     * @param Request $request
     * @return Illuminate\Support\Facades\View;
     */
    public function quote(Request $request)
    {
        $quote = $this->quoteService->quote($request->getRequest());

        return view('dashboard.quotes.detail', compact('quote'));
    }

    /**
     * @return Illuminate\Support\Facades\View;
     */
    public function getQuotes()
    {
        $quotes = $this->quoteService->getQuotes();

        return view('dashboard.quotes.history', compact('quotes'));
    }

    /**
     * @param Request
     * @return Illuminate\Support\Facades\View;
     */
    public function getQuotesByPeriod(Request $request)
    {
        $quotes = $this->quoteService->getQuotesByPeriod($request->code ?? 'USD');

        return view('dashboard.home', compact('quotes'));
    }


    /**
     * @param int $quote
     * @return bool
     */
    public function sendMail(Quote $quote)
    {
        if (! Gate::allows('sendmail', $quote))
            throw new PermissionDaniedException(trans('exception.permissionDeniedSendMail'));

        $user = $this->quoteService->sendMail($quote->id);

        return response()->json([
            'email' => $user->email
        ]);
    }
}
