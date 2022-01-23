<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Entries\ListFormPaymentEntry;
use App\Models\Services\ListFormPaymentService;

class PaymentController extends Controller
{
    /**
     * Endpoint que tras informacoes da home de um usuario.
     * @link /api/payment/list-form-payment
     *
     * @param Request [].
     * @return json List of payment methods.
     */
    public function getListFormPayment(Request $request)
    {
        try {
            
            $service = new ListFormPaymentService(new ListFormPaymentEntry($request));
            $service->Process();
            
            return response()
                    ->json($service->output)
                    ->setStatusCode(200);

        } catch (\Exception $ex) {
            return $this->retornarException($ex);
        }
    }


}
