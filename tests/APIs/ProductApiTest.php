<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Product;

class ProductApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_product()
    {
        $product = factory(Product::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/products', $product
        );

        $this->assertApiResponse($product);
    }

    /**
     * @test
     */
    public function test_read_product()
    {
        $product = factory(Product::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/products/'.$product->id
        );

        $this->assertApiResponse($product->toArray());
    }

    /**
     * @test
     */
    public function test_update_product()
    {
        $product = factory(Product::class)->create();
        $editedProduct = factory(Product::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/products/'.$product->id,
            $editedProduct
        );

        $this->assertApiResponse($editedProduct);
    }

    /**
     * @test
     */
    public function test_delete_product()
    {
        $product = factory(Product::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/products/'.$product->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/products/'.$product->id
        );

        $this->response->assertStatus(404);
    }
}
