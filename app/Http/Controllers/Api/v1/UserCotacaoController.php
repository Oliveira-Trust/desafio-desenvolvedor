<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Moeda\MoedaService;
use App\Services\User\UserCotacaoService;
use App\Services\Cotacao\PopularRegistroService;

use App\Http\Requests\UserCotacaoRequest;
use DB;

class UserCotacaoController extends Controller
{
    protected MoedaService $moedaService;
    protected UserCotacaoService $userCotacaoService;
    protected PopularRegistroService $popularRegistroService;
    private $userId = 1;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        MoedaService $moedaService,
        UserCotacaoService $userCotacaoService,
        PopularRegistroService $popularRegistroService
    ){
        $this->moedaService = $moedaService;
        $this->userCotacaoService = $userCotacaoService;
        $this->popularRegistroService = $popularRegistroService;        
    }
    
    public function index()
    {
        //$this->popularRegistroService->generate();
        return [
            'success' => true,
            'data' => $this->userCotacaoService->get()
        ];
    }


    public function show($id){
        $userCotacao = $this->userCotacaoService->show($id);
        $valorTaxado = $this->userCotacaoService->calculaCotacaoTaxas($userCotacao->id);
        $moedas = $this->moedaService->getMoedas();            

        return [
            'success' => true,
            'message' => 'Sucesso',
            'data' => [
                'val_original' => $userCotacao->val_quantia,
                'val_taxado' => $valorTaxado,
                'val_bid' => $userCotacao->val_bid,
                'resultado_conversao' => $valorTaxado * $userCotacao->val_bid,
                'taxas_aplicadas' => [
                    'taxa_sem_range' => $this->userCotacaoService->getCotacaoSemRange($userCotacao->id),
                    'taxa_com_range' => $this->userCotacaoService->getCotacaoComRange($userCotacao->id)
                ],
                'conversao' => [
                    'conversao_de' => $moedas->get($userCotacao->moeda_origem_id),
                    'conversao_para' => $moedas->get($userCotacao->moeda_destino_id)
                ]
            ]
        ];
    }

    public function calcular(UserCotacaoRequest $request){
        DB::beginTransaction();
        try {
            $cotacaoMoeda = $this->moedaService->getMoeda($request->moeda_origem_id, $request->moeda_destino_id);
            $moedas = $this->moedaService->getMoedas();            

            $request->merge([
                'user_id' => $this->userId,
                'val_bid' => $cotacaoMoeda['bid']
            ]);

            //Popula a cotação
            $userCotacaoStore = $this->userCotacaoService->storeUserCotacao($request->all());
            //Popula as taxas
            $this->userCotacaoService->storeUserCotacoesTaxas($userCotacaoStore->id, $request->tipo_cobranca_id);

            $valorTaxado = $this->userCotacaoService->calculaCotacaoTaxas($userCotacaoStore->id);

            DB::commit();

            return [
                'success' => true,
                'message' => 'Sucesso',
                'data' => [
                    'val_original' => $userCotacaoStore->val_quantia,
                    'val_taxado' => $valorTaxado,
                    'val_bid' => $userCotacaoStore->val_bid,
                    'resultado_conversao' => $valorTaxado * $userCotacaoStore->val_bid,
                    'taxas_aplicadas' => [
                        'taxa_sem_range' => $this->userCotacaoService->getCotacaoSemRange($userCotacaoStore->id),
                        'taxa_com_range' => $this->userCotacaoService->getCotacaoComRange($userCotacaoStore->id)
                    ],
                    'conversao' => [
                        'conversao_de' => $moedas->get($userCotacaoStore->moeda_origem_id),
                        'conversao_para' => $moedas->get($userCotacaoStore->moeda_destino_id)
                    ]
                ]
            ];
        } catch(\Exception $e){
            DB::rollback();
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'data' => []
            ];
        }
    }
}
