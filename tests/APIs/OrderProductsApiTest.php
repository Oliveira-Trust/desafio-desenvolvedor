<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\OrderProducts;

class OrderProductsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_order_products()
    {
        $orderProducts = factory(OrderProducts::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/order_products', $orderProducts
        );

        $this->assertApiResponse($orderProducts);
    }

    /**
     * @test
     */
    public function test_read_order_products()
    {
        $orderProducts = factory(OrderProducts::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/order_products/'.$orderProducts->id
        );

        $this->assertApiResponse($orderProducts->toArray());
    }

    /**
     * @test
     */
    public function test_update_order_products()
    {
        $orderProducts = factory(OrderProducts::class)->create();
        $editedOrderProducts = factory(OrderProducts::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/order_products/'.$orderProducts->id,
            $editedOrderProducts
        );

        $this->assertApiResponse($editedOrderProducts);
    }

    /**
     * @test
     */
    public function test_delete_order_products()
    {
        $orderProducts = factory(OrderProducts::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/order_products/'.$orderProducts->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/order_products/'.$orderProducts->id
        );

        $this->response->assertStatus(404);
    }
}
