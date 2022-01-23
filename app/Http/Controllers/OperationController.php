<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Entries\ConvertCurrencyEntry;
use App\Models\Services\ConvertCurrencyService;

use App\Models\Entries\ListOperationsEntry;
use App\Models\Services\ListOperationsService;

class OperationController extends Controller
{
    /**
     * Endpoint que tras informacoes da home de um usuario.
     * @link /api/operation/convert-currency
     *
     * @param Request ['Source currency','Destination currency','Amount','Payment method'].
     * @return json Operation status and conversion value calculations.
     */
    public function postConvertCurrency(Request $request)
    {
        try {
            
            $service = new ConvertCurrencyService(new ConvertCurrencyEntry($request));
            $service->Process();
            
            return response()
                    ->json($service->output)
                    ->setStatusCode(200);

        } catch (\Exception $ex) {
            return $this->retornarException($ex);
        }
    }

    /**
     * Endpoint que tras informacoes da home de um usuario.
     * @link /api/operation/list-operations/{user_id}
     *
     * @param Request ['User ID'].
     * @return json List of all operations by user.
     */
    public function getListOperations(Request $request)
    {
        try {
            
            $service = new ListOperationsService(new ListOperationsEntry($request));
            $service->Process();
            
            return response()
                    ->json($service->output)
                    ->setStatusCode(200);

        } catch (\Exception $ex) {
            return $this->retornarException($ex);
        }
    }


}
