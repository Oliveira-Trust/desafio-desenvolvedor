<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExchangeService;
use Illuminate\Support\Facades\Auth;
use App\Traits\GeneralHelper;
use \Exception;
use \Illuminate\Http\JsonResponse;
use App\Models\User;
use Mail;
use app\Mail\SendExchange;

class ExchangeController extends Controller
{
    use GeneralHelper;
    private ExchangeService $exchangeService;
    private User|null $user;

    public function __construct(ExchangeService $exchangeService)
    {
        $this->exchangeService = $exchangeService;
        $this->user = Auth::user();
    }

    public function simulateExchange(Request $request): JsonResponse
    {
        try {
            $input = $request->all();

            $this->exchangeService->validateInput($input);

            $exchange = $this->exchangeService->simulateExchange($input);

            if ($this->user) {
                $this->exchangeService->saveExchange($this->user, $exchange);
                // O envio de email foi não finalizado visto que o google removou a opção de acesso a apps menos seguros
                // Por causa disso, não pude fazer todas as validações necessárias
                // if ($input['send_email']) {
                //     Mail::to($this->user->email)->send(new SendExchange($exchange));
                // }
            }

            return $this->sendResponse($exchange, 'Simulação feita com sucesso');

        } catch (Exception $e) {
            return $this->responseWithError($e, 'Erro ao simular conversão');
        }
    }

    public function getUserExchanges(): JsonResponse
    {
        try {
            if (!$this->user) {
                throw new Exception(json_encode(['email/senha' => ['Usuário não autenticado']]), 401);
            }
            $exchangeList = $this->exchangeService->getExchangesByUserId($this->user);
            $message = 'Lista de simulações obtida com sucesso';

            return $this->sendResponse($exchangeList, $message);

        } catch (Exception $e) {
            return $this->responseWithError($e, 'Erro ao buscar simulações de conversão');
        }
    }
}
