<?php

namespace Tests\Feature\Product;

use Faker\Generator as Faker;
use DB;
use App\Models\User;
use App\Models\Product\Category;
use App\Models\Product\Product;
use App\Models\Customer\Customer;
use App\Models\Order\Order;
use App\Models\Order\OrderProduct;

class OrderControllerTest extends \TestCase
{
    protected static $user;
    protected static $faker;

    public function setUp(): void {
        parent::setUp();

        self::$user = factory(User::class)->create();

        self::$faker = new Faker();
        self::$faker->addProvider(new \Faker\Provider\Base (self::$faker));
    }


    /** @test */
    public function index_failed_unauthorized() {

        $this->json('GET', '/api/order', []);

        $this->seeStatusCode(401);
        $this->assertEquals("Unauthorized.", $this->response->getContent());
    }


    /** @test */
    public function index_success_with_50_items() {

        $categories = factory(Order::class, 50)->create();

        $this->actingAs(self::$user);
        $this->json('GET', '/api/order', []);

        $this->seeStatusCode(200);

        $this->seeJsonStructure([
            '*' => [
                'id', 'user_id', 'customer_id'
            ]
        ]);

        $this->assertEquals(50, count(json_decode($this->response->getContent(), 1)));
    }

    /** @test */
    public function create_failed_unauthorized() {

        $this->json('POST', '/api/order', []);

        $this->seeStatusCode(401);
        $this->assertEquals("Unauthorized.", $this->response->getContent());
    }

    /** @test */
    public function create_success_with_all_valid_fields() {


        $customer = factory(Customer::class)->create();
        $products = factory(Product::class, 3)->create();

        $order = [
            'user_id'       => self::$user->id,
            'customer_id'   => $customer->id,
            'status'        => self::$faker->randomElement(['opened', 'paid', 'canceled']),
            'products'      => [
                [
                    'product_id' => $products[0]->id,
                    'price'      => self::$faker->randomFloat(2, 1, 1000)
                ]
            ]
        ];

        $this->actingAs(self::$user);
        $this->json('POST', '/api/order', $order);

        // $this->seeStatusCode(201);
        $this->seeJson([
            'entity' => 'order',
            'action' => 'store',
            'result' => 'success'
        ]);
    }

    /** @test */
    public function create_failed_with_empty_fields() {

        $order = [
        ];

        $this->actingAs(self::$user);
        $this->json('POST', '/api/order', $order);

        $this->seeStatusCode(422);
        $this->seeJson([
            "customer_id" => ["The customer id field is required."],
            "products" =>["The products field is required."],
            "status" => ["The status field is required."]
        ]);
    }

    /** @test */
    public function show_failed_unauthorized() {

        $this->json('GET', '/api/order/'.rand(1,100), []);

        $this->seeStatusCode(401);
        $this->assertEquals("Unauthorized.", $this->response->getContent());
    }

    /** @test */
    public function show_failed_order_with_invalid_id() {

        $this->actingAs(self::$user);
        $this->json('GET', '/api/order/'.rand(1,100));

        $this->seeStatusCode(404);
        $this->seeJson([
            "message" => "Not found."
        ]);
    }

    /** @test */
    public function show_success_order_with_valid_id() {

        $order = factory(Order::class)->create();

        $this->actingAs(self::$user);
        $this->json('GET', '/api/order/'.$order->id);

        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'id', 'user_id', 'customer_id'
        ]);

        $this->seeJson($order->toArray());
    }

    /** @test */
    public function update_failed_unauthorized() {

        $this->json('PUT', '/api/order/'.rand(1,100), []);

        $this->seeStatusCode(401);
        $this->assertEquals("Unauthorized.", $this->response->getContent());
    }

    /** @test */
    public function update_success_order_with_all_valid_fields() {

        $order = factory(Order::class)->create();
        $customer = factory(Customer::class)->create();
        $products = factory(Product::class, 2)->create();

        $orderEdited = [
            'customer_id'   => $customer->id,
            'status'        => self::$faker->randomElement(['opened', 'paid', 'canceled']),
            'products'      => [
                [
                    'product_id' => $products[0]->id,
                    'price'      => self::$faker->randomFloat(2, 1, 1000)
                ],
                [
                    'product_id' => $products[1]->id,
                    'price'      => self::$faker->randomFloat(2, 1, 1000)
                ]
            ]
        ];


        $this->actingAs(self::$user);
        $this->json('PUT', '/api/order/'.$order->id, $orderEdited);

        $response = json_decode($this->response->getContent(), 1);

        $this->seeStatusCode(200);
        $this->assertEquals(count($orderEdited['products']), count($response['products']) );

    }

    /** @test */
    public function update_failed_order_with_invalid_id() {

        $this->actingAs(self::$user);
        $this->json('PUT', '/api/order/'.rand(1,100), []);

        $this->seeStatusCode(404);
        $this->seeJson([
            "message" => "Not found."
        ]);
    }

    /** @test */
    public function delete_failed_unauthorized() {

        $this->json('DELETE', '/api/order/'.rand(1,100), []);

        $this->seeStatusCode(401);
        $this->assertEquals("Unauthorized.", $this->response->getContent());
    }

    /** @test */
    public function delete_failed_order_with_invalid_id() {

        $this->actingAs(self::$user);
        $this->json('DELETE', '/api/order/'.rand(1,100), []);

        $this->seeStatusCode(404);
        $this->seeJson([
            "message" => "Not found."
        ]);
    }

    /** @test */
    public function delete_success_order_with_valid_id() {

        $order = factory(Order::class)->create();

        $this->actingAs(self::$user);
        $this->json('DELETE', '/api/order/'.$order->id);

        $this->seeStatusCode(200);

        $this->seeJson([
            "message" => "success"
        ]);

        $this->seeInDatabase('orders', ['id' => $order->id]);
    }

    /** @test */
    public function deletearray_failed_order_with_empty_ids() {

        $this->actingAs(self::$user);
        $this->json('DELETE', '/api/order', []);

        $this->seeStatusCode(422);
        $this->seeJson([
            "message" => "Empty ids."
        ]);
    }

    /** @test */
    public function deletearray_failed_order_with_invalid_id() {

        $this->actingAs(self::$user);
        $this->json('DELETE', '/api/order', ["ids" => [rand(1,100)]]);

        $this->seeStatusCode(404);
        $this->seeJson([
            "message" => "Not found."
        ]);
    }

    /** @test */
    public function deletearray_success_order_with_valids_ids() {

        $order = factory(Order::class, 10)->create();

        $this->actingAs(self::$user);
        $this->json('DELETE', '/api/order', ["ids" => [$order[3]->id, $order[6]->id, $order[9]->id]]);

        $this->seeStatusCode(200);

        $this->seeJson([
            "message" => "success"
        ]);

        $ordersDestroied = DB::table('orders')
        ->whereNotNull('deleted_at')
        ->count();

        $this->assertEquals(3, $ordersDestroied);
    }

    /** @test */
    public function deletearray_success_order_with_valid_and_invalid_ids() {

        $order = factory(Order::class, 10)->create();

        $this->actingAs(self::$user);
        $this->json('DELETE', '/api/order', ["ids" => [$order[3]->id, rand(100, 110), rand(110, 120)]]);

        $this->seeStatusCode(200);

        $this->seeJson([
            "message" => "success"
        ]);

        $ordersDestroied = DB::table('orders')
        ->whereNotNull('deleted_at')
        ->count();

        $this->assertEquals(1, $ordersDestroied);
    }
}