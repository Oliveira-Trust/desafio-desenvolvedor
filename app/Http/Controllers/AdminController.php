<?php

namespace App\Http\Controllers;

use App\Contracts\PagamentoInterface;
use App\Contracts\TaxaInterface;
use App\Http\Requests\PagamentoRequest;
use App\Http\Requests\TaxaRequest;

class AdminController extends Controller
{
    private $pagamentoRepository;
    private $taxaRepository;

    public function __construct(PagamentoInterface $pagamentoRepository, TaxaInterface $taxaRepository)
    {
        $this->pagamentoRepository = $pagamentoRepository;
        $this->taxaRepository = $taxaRepository;
    }

    public function index()
    {
        $userId = auth()->user()->id;

        $pagamentos = $this->pagamentoRepository->listarDoUsuario($userId);
        $taxas = $this->taxaRepository->listarDoUsuario($userId)->sortBy('valor');

        return view('admin.index', compact('pagamentos', 'taxas'));
    }

    public function pagamento(PagamentoRequest $request)
    {
        $pagamento = $this->pagamentoRepository->store($request->all());

        return response()->json([
            'action'    =>  'redirect',
        ]);
    }

    public function taxa(TaxaRequest $request)
    {
        try {
            $pagamento = $this->taxaRepository->store($request->all());
        } catch (\Exception $e) {
            return response()->json([
                'success'    =>  false,
                'message'    =>  'Esse valor já se encontra cadastrado, por favor, tente com outro valor.'
            ]);
        }

        return response()->json([
            'action'    =>  'redirect',
        ]);
    }
}
