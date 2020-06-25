<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Order;

class OrderApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_order()
    {
        $order = factory(Order::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/orders', $order
        );

        $this->assertApiResponse($order);
    }

    /**
     * @test
     */
    public function test_read_order()
    {
        $order = factory(Order::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/orders/'.$order->id
        );

        $this->assertApiResponse($order->toArray());
    }

    /**
     * @test
     */
    public function test_update_order()
    {
        $order = factory(Order::class)->create();
        $editedOrder = factory(Order::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/orders/'.$order->id,
            $editedOrder
        );

        $this->assertApiResponse($editedOrder);
    }

    /**
     * @test
     */
    public function test_delete_order()
    {
        $order = factory(Order::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/orders/'.$order->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/orders/'.$order->id
        );

        $this->response->assertStatus(404);
    }
}
