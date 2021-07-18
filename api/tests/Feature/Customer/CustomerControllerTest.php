<?php

namespace Tests\Feature\Customer;

use Faker\Generator as Faker;
use DB;
use App\Models\User;
use App\Models\Customer;

class CustomerControllerTest extends \TestCase
{
    protected static $user;

    public function setUp(): void {
        parent::setUp();

        self::$user = factory(User::class)->create();
    }

    /** @test */
    public function index_failed_unauthorized() {

        $this->json('GET', '/api/customer', []);

        $this->seeStatusCode(401);
        $this->assertEquals("Unauthorized.", $this->response->getContent());
    }

    /** @test */
    public function index_success_with_50_items() {

        $customers = factory(Customer::class, 50)->create();

        $this->actingAs(self::$user);
        $this->json('GET', '/api/customer', []);

        $this->seeStatusCode(200);

        $this->seeJsonStructure([
            '*' => [
                'id', 'name', 'email', 'cpf', 'phone', 'created_at', 'updated_at'
            ]
        ]);

        $this->assertEquals(50, count(json_decode($this->response->getContent(), 1)));
    }

    /** @test */
    public function create_failed_unauthorized() {

        $this->json('POST', '/api/customer', []);

        $this->seeStatusCode(401);
        $this->assertEquals("Unauthorized.", $this->response->getContent());
    }

    /** @test */
    public function create_failed_customer_with_emtpy_name_field_and_empty_cpf_field() {

        $customer = [
        ];

        $this->actingAs(self::$user);
        $this->json('POST', '/api/customer', $customer);

        $this->seeStatusCode(422);
        $this->seeJson([
            "name" => ["The name field is required."],
            "cpf" => ["The cpf field is required."],
        ]);
    }

    /** @test */
    public function create_failed_customer_with_duplicated_cpf_field() {

        $faker = new Faker();
        $faker->addProvider(new \Faker\Provider\pt_BR\Person ($faker));
        $faker->addProvider(new \Faker\Provider\pt_BR\PhoneNumber ($faker));
        $faker->addProvider(new \Faker\Provider\en_US\Address($faker));
        $faker->addProvider(new \Faker\Provider\Internet ($faker));

        $customer = [
            'name' => $faker->name,
            'cpf' => $faker->cpf
        ];
        $this->actingAs(self::$user);
        $this->json('POST', '/api/customer', $customer);
        $this->json('POST', '/api/customer', $customer);

        $this->seeStatusCode(422);
        $this->seeJson([
            "cpf" => ["The cpf has already been taken."]
        ]);
    }

    /** @test */
    public function create_success_customer_with_all_fields() {

        $faker = new Faker();
        $faker->addProvider(new \Faker\Provider\pt_BR\Person ($faker));
        $faker->addProvider(new \Faker\Provider\pt_BR\PhoneNumber ($faker));
        $faker->addProvider(new \Faker\Provider\en_US\Address($faker));
        $faker->addProvider(new \Faker\Provider\Internet ($faker));

        $customer = [
            'name' => $faker->name,
            'email' => $faker->email,
            'cpf' => $faker->cpf,
            'phone' => $faker->cellphoneNumber,
            'address' => $faker->address
        ];

        $this->actingAs(self::$user);
        $this->json('POST', '/api/customer', $customer);

        $this->seeStatusCode(201);
        $this->seeJson([
            'entity' => 'customers',
            'action' => 'store',
            'result' => 'success'
        ]);
    }

    /** @test */
    public function create_success_customer_with_only_required_fields() {

        $faker = new Faker();
        $faker->addProvider(new \Faker\Provider\pt_BR\Person ($faker));

        $customer = [
            'name' => $faker->name,
            'cpf' => $faker->cpf
        ];

        $this->actingAs(self::$user);
        $this->json('POST', '/api/customer', $customer);

        $this->seeStatusCode(201);
        $this->seeJson([
            'entity' => 'customers',
            'action' => 'store',
            'result' => 'success'
        ]);
    }

    /** @test */
    public function show_failed_unauthorized() {

        $this->json('GET', '/api/customer/'.rand(1,100), []);

        $this->seeStatusCode(401);
        $this->assertEquals("Unauthorized.", $this->response->getContent());
    }

    /** @test */
    public function show_failed_customer_with_invalid_id() {

        $this->actingAs(self::$user);
        $this->json('GET', '/api/customer/'.rand(1,100));

        $this->seeStatusCode(404);
        $this->seeJson([
            "message" => "Not found."
        ]);
    }

    /** @test */
    public function show_success_customer_with_valid_id() {

        $customer = factory(Customer::class)->create();

        $this->actingAs(self::$user);
        $this->json('GET', '/api/customer/'.$customer->id);

        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'id', 'name', 'email', 'cpf', 'phone', 'created_at', 'updated_at'
        ]);

        $this->seeJson($customer->toArray());
    }

    /** @test */
    public function update_failed_unauthorized() {

        $this->json('PUT', '/api/customer/'.rand(1,100), []);

        $this->seeStatusCode(401);
        $this->assertEquals("Unauthorized.", $this->response->getContent());
    }

    /** @test */
    public function update_success_customer_with_all_valid_fields() {

        $customer = factory(Customer::class)->create();

        $faker = new Faker();
        $faker->addProvider(new \Faker\Provider\pt_BR\Person ($faker));
        $faker->addProvider(new \Faker\Provider\pt_BR\PhoneNumber ($faker));
        $faker->addProvider(new \Faker\Provider\en_US\Address($faker));
        $faker->addProvider(new \Faker\Provider\Internet ($faker));

        $customerEdited = [
            'name' => $faker->name,
            'email' => $faker->email,
            'cpf' => $faker->cpf,
            'phone' => $faker->cellphoneNumber,
            'address' => $faker->address
        ];

        $this->actingAs(self::$user);
        $this->json('PUT', '/api/customer/'.$customer->id, $customerEdited);

        $this->seeJson($customerEdited);

    }

    /** @test */
    public function update_success_customer_with_only_email_field() {

        $customer = factory(Customer::class)->create();

        $faker = new Faker();
        $faker->addProvider(new \Faker\Provider\pt_BR\Person ($faker));
        $faker->addProvider(new \Faker\Provider\Internet ($faker));

        $customerEdited = [
            'email' => $faker->email
        ];

        $this->actingAs(self::$user);
        $this->json('PUT', '/api/customer/'.$customer->id, $customerEdited);

        $this->seeJson($customerEdited);
    }

    /** @test */
    public function update_failed_customer_with_invalid_id() {

        $this->actingAs(self::$user);
        $this->json('PUT', '/api/customer/'.rand(1,100), []);

        $this->seeStatusCode(404);
        $this->seeJson([
            "message" => "Not found."
        ]);
    }

    /** @test */
    public function update_failed_customer_without_fields() {

        $customer = factory(Customer::class)->create();

        $this->actingAs(self::$user);
        $this->json('PUT', '/api/customer/'.$customer->id, []);

        $this->seeStatusCode(400);
        $this->seeJson([
            "message" => "Nothing to change."
        ]);
    }


    /** @test */
    public function update_failed_customer_with_duplicated_cpf_field() {

        $customers = factory(Customer::class, 3)->create();

        $customer = [
            'cpf' => $customers[1]->cpf
        ];
        $this->actingAs(self::$user);
        $this->json('PUT', '/api/customer/'.$customers[0]->id, $customer);

        $this->seeStatusCode(422);
        $this->seeJson([
            "cpf" => ["The cpf has already been taken."]
        ]);
    }

    /** @test */
    public function delete_failed_unauthorized() {

        $this->json('DELETE', '/api/customer/'.rand(1,100), []);

        $this->seeStatusCode(401);
        $this->assertEquals("Unauthorized.", $this->response->getContent());
    }

    /** @test */
    public function delete_failed_customer_with_invalid_id() {

        $this->actingAs(self::$user);
        $this->json('DELETE', '/api/customer/'.rand(1,100), []);

        $this->seeStatusCode(404);
        $this->seeJson([
            "message" => "Not found."
        ]);
    }

    /** @test */
    public function delete_success_customer_with_valid_id() {

        $customer = factory(Customer::class)->create();

        $this->actingAs(self::$user);
        $this->json('DELETE', '/api/customer/'.$customer->id);

        $this->seeStatusCode(200);

        $this->seeJson([
            "message" => "success"
        ]);

        $this->seeInDatabase('customers', ['id' => $customer->id]);
    }


    /** @test */
    public function deletearray_failed_customer_with_empty_ids() {

        $this->actingAs(self::$user);
        $this->json('DELETE', '/api/customer', []);

        $this->seeStatusCode(422);
        $this->seeJson([
            "message" => "Empty ids."
        ]);
    }

    /** @test */
    public function deletearray_failed_customer_with_invalid_id() {

        $this->actingAs(self::$user);
        $this->json('DELETE', '/api/customer', ["ids" => [rand(1,100)]]);

        $this->seeStatusCode(404);
        $this->seeJson([
            "message" => "Not found."
        ]);
    }

    /** @test */
    public function deletearray_success_customer_with_valids_ids() {

        $customer = factory(Customer::class, 10)->create();

        $this->actingAs(self::$user);
        $this->json('DELETE', '/api/customer', ["ids" => [$customer[3]->id, $customer[6]->id, $customer[9]->id]]);

        $this->seeStatusCode(200);

        $this->seeJson([
            "message" => "success"
        ]);

        $customersDestroied = DB::table('customers')
        ->whereNotNull('deleted_at')
        ->count();

        $this->assertEquals(3, $customersDestroied);
    }

    /** @test */
    public function deletearray_success_customer_with_valid_and_invalid_ids() {

        $customer = factory(Customer::class, 10)->create();

        $this->actingAs(self::$user);
        $this->json('DELETE', '/api/customer', ["ids" => [$customer[3]->id, rand(100, 110), rand(110, 120)]]);

        $this->seeStatusCode(200);

        $this->seeJson([
            "message" => "success"
        ]);

        $customersDestroied = DB::table('customers')
        ->whereNotNull('deleted_at')
        ->count();

        $this->assertEquals(1, $customersDestroied);
    }

}