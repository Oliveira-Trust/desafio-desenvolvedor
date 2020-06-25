<?php namespace Tests\Repositories;

use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class OrderRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var OrderRepository
     */
    protected $orderRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->orderRepo = \App::make(OrderRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_order()
    {
        $order = factory(Order::class)->make()->toArray();

        $createdOrder = $this->orderRepo->create($order);

        $createdOrder = $createdOrder->toArray();
        $this->assertArrayHasKey('id', $createdOrder);
        $this->assertNotNull($createdOrder['id'], 'Created Order must have id specified');
        $this->assertNotNull(Order::find($createdOrder['id']), 'Order with given id must be in DB');
        $this->assertModelData($order, $createdOrder);
    }

    /**
     * @test read
     */
    public function test_read_order()
    {
        $order = factory(Order::class)->create();

        $dbOrder = $this->orderRepo->find($order->id);

        $dbOrder = $dbOrder->toArray();
        $this->assertModelData($order->toArray(), $dbOrder);
    }

    /**
     * @test update
     */
    public function test_update_order()
    {
        $order = factory(Order::class)->create();
        $fakeOrder = factory(Order::class)->make()->toArray();

        $updatedOrder = $this->orderRepo->update($fakeOrder, $order->id);

        $this->assertModelData($fakeOrder, $updatedOrder->toArray());
        $dbOrder = $this->orderRepo->find($order->id);
        $this->assertModelData($fakeOrder, $dbOrder->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_order()
    {
        $order = factory(Order::class)->create();

        $resp = $this->orderRepo->delete($order->id);

        $this->assertTrue($resp);
        $this->assertNull(Order::find($order->id), 'Order should not exist in DB');
    }
}
