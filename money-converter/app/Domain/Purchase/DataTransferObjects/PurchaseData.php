<?php

namespace Domain\Purchase\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;
use App\Api\Purchase\Requests\PurchaseRequest;

class PurchaseData extends DataTransferObject
{
    /**
     * @var string
     */
    public $origin;

    /**
     * @var string
     */
    public $destiny;

    /**
     * @var int
     */
    public $value;

    /**
     * @var string
     */
    public $payment_method;

    public static function fromRequest(PurchaseRequest $request): PurchaseData
    {
        return new self([
            'origin' => $request->input('origin'),
            'destiny' => $request->input('destiny'),
            'value' => $request->input('value'),
            'payment_method' => $request->input('payment_method'),
        ]);
    }
}
