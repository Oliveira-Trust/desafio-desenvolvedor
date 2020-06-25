<?php namespace Tests\Repositories;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ProductRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProductRepository
     */
    protected $productRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->productRepo = \App::make(ProductRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_product()
    {
        $product = factory(Product::class)->make()->toArray();

        $createdProduct = $this->productRepo->create($product);

        $createdProduct = $createdProduct->toArray();
        $this->assertArrayHasKey('id', $createdProduct);
        $this->assertNotNull($createdProduct['id'], 'Created Product must have id specified');
        $this->assertNotNull(Product::find($createdProduct['id']), 'Product with given id must be in DB');
        $this->assertModelData($product, $createdProduct);
    }

    /**
     * @test read
     */
    public function test_read_product()
    {
        $product = factory(Product::class)->create();

        $dbProduct = $this->productRepo->find($product->id);

        $dbProduct = $dbProduct->toArray();
        $this->assertModelData($product->toArray(), $dbProduct);
    }

    /**
     * @test update
     */
    public function test_update_product()
    {
        $product = factory(Product::class)->create();
        $fakeProduct = factory(Product::class)->make()->toArray();

        $updatedProduct = $this->productRepo->update($fakeProduct, $product->id);

        $this->assertModelData($fakeProduct, $updatedProduct->toArray());
        $dbProduct = $this->productRepo->find($product->id);
        $this->assertModelData($fakeProduct, $dbProduct->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_product()
    {
        $product = factory(Product::class)->create();

        $resp = $this->productRepo->delete($product->id);

        $this->assertTrue($resp);
        $this->assertNull(Product::find($product->id), 'Product should not exist in DB');
    }
}
