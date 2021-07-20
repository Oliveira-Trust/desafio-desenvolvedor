<?php

namespace App\Repository\Order;

use App\Repository\AbstractDataTransferObject;

class OrderDTO extends AbstractDataTransferObject {
    private ?int $id = 0;
    public ?int $user_id = 0;
    public ?int $customer_id = 0;
    public ?array $products = [];
    public ?string $status = "";

    public function __construct(array $parameter) {
        parent::__construct($parameter);
        if ($this->user_id === 0) {
            $this->user_id = auth()->user()->id;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules() {
        return [
            'user_id' => 'integer|exists:users,id',
            'customer_id' => 'required|integer|exists:customers,id',
            'status' => 'required|in:opened,paid,canceled',
            'products' => 'required|array',
            'products.*.product_id' => 'required|integer|exists:products,id',
            'products.*.price' => 'required|numeric',
        ];
    }
    public static function rulesUpdate(int $id) {
        return [
            'user_id' => 'integer|exists:users,id',
            'customer_id' => 'integer|exists:customers,id',
            'products' => 'array',
            'products.*.product_id' => 'integer|exists:products,id',
            'products.*.price' => 'numeric',
        ];
    }
}