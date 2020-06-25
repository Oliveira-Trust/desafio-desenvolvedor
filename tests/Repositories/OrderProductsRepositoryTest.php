<?php namespace Tests\Repositories;

use App\Models\OrderProducts;
use App\Repositories\OrderProductsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class OrderProductsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var OrderProductsRepository
     */
    protected $orderProductsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->orderProductsRepo = \App::make(OrderProductsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_order_products()
    {
        $orderProducts = factory(OrderProducts::class)->make()->toArray();

        $createdOrderProducts = $this->orderProductsRepo->create($orderProducts);

        $createdOrderProducts = $createdOrderProducts->toArray();
        $this->assertArrayHasKey('id', $createdOrderProducts);
        $this->assertNotNull($createdOrderProducts['id'], 'Created OrderProducts must have id specified');
        $this->assertNotNull(OrderProducts::find($createdOrderProducts['id']), 'OrderProducts with given id must be in DB');
        $this->assertModelData($orderProducts, $createdOrderProducts);
    }

    /**
     * @test read
     */
    public function test_read_order_products()
    {
        $orderProducts = factory(OrderProducts::class)->create();

        $dbOrderProducts = $this->orderProductsRepo->find($orderProducts->id);

        $dbOrderProducts = $dbOrderProducts->toArray();
        $this->assertModelData($orderProducts->toArray(), $dbOrderProducts);
    }

    /**
     * @test update
     */
    public function test_update_order_products()
    {
        $orderProducts = factory(OrderProducts::class)->create();
        $fakeOrderProducts = factory(OrderProducts::class)->make()->toArray();

        $updatedOrderProducts = $this->orderProductsRepo->update($fakeOrderProducts, $orderProducts->id);

        $this->assertModelData($fakeOrderProducts, $updatedOrderProducts->toArray());
        $dbOrderProducts = $this->orderProductsRepo->find($orderProducts->id);
        $this->assertModelData($fakeOrderProducts, $dbOrderProducts->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_order_products()
    {
        $orderProducts = factory(OrderProducts::class)->create();

        $resp = $this->orderProductsRepo->delete($orderProducts->id);

        $this->assertTrue($resp);
        $this->assertNull(OrderProducts::find($orderProducts->id), 'OrderProducts should not exist in DB');
    }
}
