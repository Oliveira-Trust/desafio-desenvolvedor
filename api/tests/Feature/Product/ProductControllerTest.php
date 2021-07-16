<?php

namespace Tests\Feature\Product;

use Faker\Generator as Faker;

use App\Models\User;
use App\Models\Product\Category;
use App\Models\Product\Product;

class ProductControllerTest extends \TestCase
{
    protected static $user;

    public function setUp(): void {
        parent::setUp();

        self::$user = factory(User::class)->create();
    }

    /** @test */
    public function index_failed_unauthorized() {

        $this->json('GET', '/api/product', []);

        $this->seeStatusCode(401);
        $this->assertEquals("Unauthorized.", $this->response->getContent());
    }

    /** @test */
    public function index_success_with_50_items() {

        $products = factory(Product::class, 50)->create();

        $this->actingAs(self::$user);
        $this->json('GET', '/api/product', []);

        $this->seeStatusCode(200);

        $this->seeJsonStructure([
            '*' => [
                'id', 'name', 'category_id', 'description', 'color', 'size', 'price', 'created_at', 'updated_at'
            ]
        ]);

        $this->assertEquals(50, count(json_decode($this->response->getContent(), 1)));
    }

    /** @test */
    public function create_failed_unauthorized() {

        $this->json('POST', '/api/product', []);

        $this->seeStatusCode(401);
        $this->assertEquals("Unauthorized.", $this->response->getContent());
    }

    /** @test */
    public function create_success_with_all_valid_fields() {

        $faker = new Faker();
        $faker->addProvider(new \Faker\Provider\pt_BR\Person ($faker));
        $faker->addProvider(new \Faker\Provider\Lorem ($faker));
        $faker->addProvider(new \Faker\Provider\Color ($faker));

        $caregory = factory(Category::class)->create();

        $product = [
            'name'          => $faker->name,
            'category_id'   => $caregory->id,
            'description'   => $faker->text,
            'size'          => $faker->randomFloat(2, 1, 1000),
            'color'         => $faker->hexcolor,
            'price'         => $faker->randomFloat(2, 1, 1000)
        ];

        $this->actingAs(self::$user);
        $this->json('POST', '/api/product', $product);

        $this->seeStatusCode(201);
        $this->seeJson([
            'entity' => 'product',
            'action' => 'store',
            'result' => 'success'
        ]);
    }

    /** @test */
    public function create_success_only_with_required_fields() {

        $faker = new Faker();
        $faker->addProvider(new \Faker\Provider\pt_BR\Person ($faker));
        $faker->addProvider(new \Faker\Provider\Lorem ($faker));
        $faker->addProvider(new \Faker\Provider\Color ($faker));

        $caregory = factory(Category::class)->create();

        $product = [
            'name'          => $faker->name,
            'category_id'   => $caregory->id
        ];

        $this->actingAs(self::$user);
        $this->json('POST', '/api/product', $product);

        $this->seeStatusCode(201);
        $this->seeJson([
            'entity' => 'product',
            'action' => 'store',
            'result' => 'success'
        ]);
    }

    /** @test */
    public function create_failed_with_empty_fields() {

        $product = [
        ];

        $this->actingAs(self::$user);
        $this->json('POST', '/api/product', $product);

        $this->seeStatusCode(422);
        $this->seeJson([
            "name" => ["The name field is required."],
            "category_id" => ["The category id field is required."],
        ]);
    }

    /** @test */
    public function create_failed_product_with_duplicated_name_field() {

        $faker = new Faker();
        $faker->addProvider(new \Faker\Provider\pt_BR\Person ($faker));

        $caregory = factory(Category::class)->create();

        $product = [
            'name' => $faker->name,
            'category_id'   => $caregory->id
        ];
        $this->actingAs(self::$user);
        $this->json('POST', '/api/product', $product);
        $this->json('POST', '/api/product', $product);

        $this->seeStatusCode(422);
        $this->seeJson([
            "name" => ["The name has already been taken."]
        ]);
    }


    /** @test */
    public function show_failed_unauthorized() {

        $this->json('GET', '/api/product/'.rand(1,100), []);

        $this->seeStatusCode(401);
        $this->assertEquals("Unauthorized.", $this->response->getContent());
    }

    /** @test */
    public function show_failed_product_with_invalid_id() {

        $this->actingAs(self::$user);
        $this->json('GET', '/api/product/'.rand(1,100));

        $this->seeStatusCode(404);
        $this->seeJson([
            "message" => "Not found."
        ]);
    }

    /** @test */
    public function show_success_product_with_valid_id() {

        $product = factory(Product::class)->create();

        $this->actingAs(self::$user);
        $this->json('GET', '/api/product/'.$product->id);

        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'id', 'name', 'category_id', 'description', 'color', 'size', 'price'
        ]);

        $this->seeJson($product->toArray());
    }

    /** @test */
    public function update_failed_unauthorized() {

        $this->json('PUT', '/api/product/'.rand(1,100), []);

        $this->seeStatusCode(401);
        $this->assertEquals("Unauthorized.", $this->response->getContent());
    }

    /** @test */
    public function update_success_product_with_all_valid_fields() {

        $product = factory(Product::class)->create();

        $faker = new Faker();
        $faker->addProvider(new \Faker\Provider\pt_BR\Person ($faker));
        $faker->addProvider(new \Faker\Provider\Lorem ($faker));
        $faker->addProvider(new \Faker\Provider\Color ($faker));

        $caregory = factory(Category::class)->create();

        $productEdited = [
            'name'          => $faker->name,
            'category_id'   => $caregory->id,
            'description'   => $faker->text,
            'size'          => $faker->randomFloat(2, 1, 1000),
            'color'         => $faker->hexcolor,
            'price'         => $faker->randomFloat(2, 1, 1000)
        ];

        $this->actingAs(self::$user);
        $this->json('PUT', '/api/product/'.$product->id, $productEdited);

        $this->seeJson($productEdited);

    }

    /** @test */
    public function update_success_product_with_only_price_field() {

        $product = factory(Product::class)->create();

        $faker = new Faker();
        $faker->addProvider(new \Faker\Provider\Base ($faker));

        $productEdited = [
            'price' => $faker->randomFloat(2, 1, 1000)
        ];

        $this->actingAs(self::$user);
        $this->json('PUT', '/api/product/'.$product->id, $productEdited);

        $this->seeJson($productEdited);
    }

    /** @test */
    public function update_failed_product_with_invalid_id() {

        $this->actingAs(self::$user);
        $this->json('PUT', '/api/product/'.rand(1,100), []);

        $this->seeStatusCode(404);
        $this->seeJson([
            "message" => "Not found."
        ]);
    }

    /** @test */
    public function update_failed_product_without_fields() {

        $product = factory(Product::class)->create();

        $this->actingAs(self::$user);
        $this->json('PUT', '/api/product/'.$product->id, []);

        $this->seeStatusCode(400);
        $this->seeJson([
            "message" => "Nothing to change."
        ]);
    }

    /** @test */
    public function update_failed_product_with_duplicated_name_field() {

        $products = factory(Product::class, 3)->create();

        $product = [
            'name' => $products[1]->name
        ];
        $this->actingAs(self::$user);
        $this->json('PUT', '/api/product/'.$products[0]->id, $product);

        $this->seeStatusCode(422);
        $this->seeJson([
            "name" => ["The name has already been taken."]
        ]);
    }


    /** @test */
    public function update_failed_product_with_fields_no_changed() {

        $product = factory(Product::class)->create();

        $this->actingAs(self::$user);
        $this->json('PUT', '/api/product/'.$product->id, $product->toArray());

        $this->seeStatusCode(400);
        $this->seeJson([
            "message" => "Nothing to change."
        ]);
    }

    /** @test */
    public function delete_failed_unauthorized() {

        $this->json('DELETE', '/api/product/'.rand(1,100), []);

        $this->seeStatusCode(401);
        $this->assertEquals("Unauthorized.", $this->response->getContent());
    }

    /** @test */
    public function delete_failed_product_with_invalid_id() {

        $this->actingAs(self::$user);
        $this->json('DELETE', '/api/product/'.rand(1,100), []);

        $this->seeStatusCode(404);
        $this->seeJson([
            "message" => "Not found."
        ]);
    }

    /** @test */
    public function delete_success_product_with_valid_id() {

        $product = factory(Product::class)->create();

        $this->actingAs(self::$user);
        $this->json('DELETE', '/api/product/'.$product->id);

        $this->seeStatusCode(200);

        $this->seeJson([
            "message" => "success"
        ]);

        $this->seeInDatabase('products', ['id' => $product->id]);
    }
}