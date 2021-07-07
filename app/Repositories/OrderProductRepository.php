<?php 

namespace App\Repositories;

use App\Models\Product;
use App\Models\OrderProduct;

class OrderProductRepository {

	public function create($data){
		$model = app(OrderProduct::class);
		return $model->create($data);
	}

	/**
	 * cria os detalhes do pedido com seus produtos de acordo com os dados informados
	 *
	 * @param array $request
	 * @param int $order
	 * @return bool
	 */
    public function createFromData($request, $order){
		$model = app(OrderProduct::class);
		$productModel = app(Product::class);
		
		foreach ($request['cart'] as $key => $value) {
			$product = $productModel->findOrfail($value['productId']);
			
			$data = [
				'order_id'       =>    $order,
				'product_id'     =>    $product->id,
				'value'          =>    $product->value,
				'quantity'     	 =>    $value['productQuantity'],
			];
			$model->create($data);
		}
		return true;
    }

}