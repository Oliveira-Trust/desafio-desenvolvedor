<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Entries\ListCoinsEntry;
use App\Models\Services\ListCoinsService;

class CoinController extends Controller
{
   
    /**
     * Endpoint que tras informacoes da home de um usuario.
     * @link /api/coin/list-coins
     *
     * @param Request [].
     * @return json List currency for conversion.
     */
    public function getListCoins(Request $request)
    {
        try {
            
            $service = new ListCoinsService(new ListCoinsEntry($request));
            $service->Process();
            
            return response()
                    ->json($service->output)
                    ->setStatusCode(200);

        } catch (\Exception $ex) {
            return $this->retornarException($ex);
        }
    }

}
