<?php

namespace App\Http\Controllers;

use App\Events\EmailSent;
use Illuminate\Http\Request;
use App\Http\Requests\CotationRequest;
use App\Mail\CotationMail;
use App\Models\Cotation;
use App\Services\CotationService;
use App\Services\EconomiaApiService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CotationController extends Controller
{
    protected $cotationService;
    protected $economiaApiService;

    public function __construct(EconomiaApiService $economiaApiService, CotationService $cotationService)
    {
        $this->economiaApiService = $economiaApiService;
        $this->cotationService = $cotationService;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        try {
            $currencies = $this->economiaApiService->getAvailableCurrencies();
            $cotations = $this->cotationService->getAllCotationsByUserId(Auth::id());
            return view('home', ['cotations' => $cotations, 'currencies' => $currencies]);
        } catch (\Exception $e) {
            return Redirect::route('home')->with('error', 'Erro ao iniciar: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('cotations.create');
    }

    public function store(CotationRequest $request)
    {

        try {
            
            DB::beginTransaction();
            $cotation = $this->cotationService->save($request->all());
            DB::commit();

            return Redirect::route('home')->with('success', 'Cotação feita com sucesso!');
        } catch (RequestException $e) {
            return Redirect::route('home')->with('error', 'Erro ao efetuar cotação: ' . $e->getMessage());
            DB::rollback();
        } catch (\Exception $e) {
            return Redirect::route('home')->with('error', 'Erro ao efetuar cotação: ' . $e->getMessage());
            DB::rollback();
        }
    }

    public function sendEmail($id){

        try {

            $cotation = $this->cotationService->getCotationById($id);

            $user = Auth::user();
            $email = $user->email;

            $mailData = [
                'name' => $user->name,
                'cotation' => $cotation
            ];


            Mail::to($user->email)->send(new CotationMail($mailData));
            return response()->json(['type' => 'success', 'message' => 'Email enviado com sucesso'], 201);
            
        } catch (RequestException $e) {
            return response()->json(['type' => 'error', 'message' => 'Erro ao consultar (1): ' . $e->getMessage()], 500);

            DB::rollback();
        } catch (\Exception $e) {
            return response()->json(['type' => 'error', 'message' => 'Erro ao consultar (2): ' . $e->getMessage()], 500);

            DB::rollback();
        }
    }

    public function show($id)
    {

        try {

            $cotation = $this->cotationService->getCotationById($id);

            return response()->json($cotation, 201);

            return Redirect::route('home')->with('success', 'Cotação feita com sucesso!');
        } catch (RequestException $e) {
            return response()->json(['message' => 'Erro ao consultar (1): ' . $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao consultar (2): ' . $e->getMessage()], 404);
        }
    }
}
