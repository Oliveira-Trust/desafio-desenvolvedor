<?php

use Selene\Render\View;
use Selene\Request\Request;
use Selene\Response\Response;
use App\Actions\UpdateTaxesAction;
use Selene\Controllers\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;

class AdminConfigController extends BaseController
{
    public function index(): View
    {
        return $this->view()->render(
            'pages/admin-config.html',
            [
                'pageTitle' => 'Configurar Taxas de conversão'
            ]
        );
    }

    public function updateTaxes(Request $request, Response $response): JsonResponse
    {
        try {
            (new UpdateTaxesAction)->run($request);
            return $response->success([
                'message' => 'Taxa atualizada com sucesso'
            ]);
        } catch (\Throwable $th) {
            return $response->error($th);
        }
    }
}
