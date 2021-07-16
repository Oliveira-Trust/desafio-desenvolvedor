<?php

namespace Tests\Feature\Product;

use Faker\Generator as Faker;

use App\Models\User;
use App\Models\Product\Category;

class CategoryControllerTest extends \TestCase
{
    protected static $user;

    public function setUp(): void {
        parent::setUp();

        self::$user = factory(User::class)->create();
    }

    /** @test */
    public function index_failed_unauthorized() {

        $this->json('GET', '/api/category', []);

        $this->seeStatusCode(401);
        $this->assertEquals("Unauthorized.", $this->response->getContent());
    }

    /** @test */
    public function index_success_with_50_items() {

        $categories = factory(Category::class, 50)->create();

        $this->actingAs(self::$user);
        $this->json('GET', '/api/category', []);

        $this->seeStatusCode(200);

        $this->seeJsonStructure([
            '*' => [
                'id', 'name'
            ]
        ]);

        $this->assertEquals(50, count(json_decode($this->response->getContent(), 1)));
    }

    /** @test */
    public function create_failed_unauthorized() {

        $this->json('POST', '/api/category', []);

        $this->seeStatusCode(401);
        $this->assertEquals("Unauthorized.", $this->response->getContent());
    }

    /** @test */
    public function create_success_with_all_valid_fields() {

        $faker = new Faker();
        $faker->addProvider(new \Faker\Provider\pt_BR\Person ($faker));

        $category = [
            'name'  => $faker->name
        ];

        $this->actingAs(self::$user);
        $this->json('POST', '/api/category', $category);

        $this->seeStatusCode(201);
        $this->seeJson([
            'entity' => 'category',
            'action' => 'store',
            'result' => 'success'
        ]);
    }

    /** @test */
    public function create_success_only_with_required_fields() {

        $faker = new Faker();
        $faker->addProvider(new \Faker\Provider\pt_BR\Person ($faker));
        $faker->addProvider(new \Faker\Provider\Lorem ($faker));

        $category = [
            'name'          => $faker->name,
        ];

        $this->actingAs(self::$user);
        $this->json('POST', '/api/category', $category);

        $this->seeStatusCode(201);
        $this->seeJson([
            'entity' => 'category',
            'action' => 'store',
            'result' => 'success'
        ]);
    }

    /** @test */
    public function create_failed_with_empty_fields() {

        $category = [
        ];

        $this->actingAs(self::$user);
        $this->json('POST', '/api/category', $category);

        $this->seeStatusCode(422);
        $this->seeJson([
            "name" => ["The name field is required."]
        ]);
    }

    /** @test */
    public function create_failed_category_with_duplicated_name_field() {

        $faker = new Faker();
        $faker->addProvider(new \Faker\Provider\pt_BR\Person ($faker));

        $category = [
            'name' => $faker->name
        ];
        $this->actingAs(self::$user);
        $this->json('POST', '/api/category', $category);
        $this->json('POST', '/api/category', $category);

        $this->seeStatusCode(422);
        $this->seeJson([
            "name" => ["The name has already been taken."]
        ]);
    }


    /** @test */
    public function show_failed_unauthorized() {

        $this->json('GET', '/api/category/'.rand(1,100), []);

        $this->seeStatusCode(401);
        $this->assertEquals("Unauthorized.", $this->response->getContent());
    }

    /** @test */
    public function show_failed_category_with_invalid_id() {

        $this->actingAs(self::$user);
        $this->json('GET', '/api/category/'.rand(1,100));

        $this->seeStatusCode(404);
        $this->seeJson([
            "message" => "Not found."
        ]);
    }

    /** @test */
    public function show_success_category_with_valid_id() {

        $category = factory(Category::class)->create();

        $this->actingAs(self::$user);
        $this->json('GET', '/api/category/'.$category->id);

        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'id', 'name'
        ]);

        $this->seeJson($category->toArray());
    }

    /** @test */
    public function update_failed_unauthorized() {

        $this->json('PUT', '/api/category/'.rand(1,100), []);

        $this->seeStatusCode(401);
        $this->assertEquals("Unauthorized.", $this->response->getContent());
    }

    /** @test */
    public function update_success_category_with_all_valid_fields() {

        $category = factory(Category::class)->create();

        $faker = new Faker();
        $faker->addProvider(new \Faker\Provider\pt_BR\Person ($faker));
        $faker->addProvider(new \Faker\Provider\Lorem ($faker));

        $categoryEdited = [
            'name'          => $faker->name
        ];

        $this->actingAs(self::$user);
        $this->json('PUT', '/api/category/'.$category->id, $categoryEdited);

        $this->seeJson($categoryEdited);

    }

    /** @test */
    public function update_failed_category_with_invalid_id() {

        $this->actingAs(self::$user);
        $this->json('PUT', '/api/category/'.rand(1,100), []);

        $this->seeStatusCode(404);
        $this->seeJson([
            "message" => "Not found."
        ]);
    }

    /** @test */
    public function update_failed_category_without_fields() {

        $category = factory(Category::class)->create();

        $this->actingAs(self::$user);
        $this->json('PUT', '/api/category/'.$category->id, []);

        $this->seeStatusCode(400);
        $this->seeJson([
            "message" => "Nothing to change."
        ]);
    }

    /** @test */
    public function update_failed_category_with_duplicated_name_field() {

        $categories = factory(Category::class, 3)->create();

        $category = [
            'name' => $categories[1]->name
        ];
        $this->actingAs(self::$user);
        $this->json('PUT', '/api/category/'.$categories[0]->id, $category);

        $this->seeStatusCode(422);
        $this->seeJson([
            "name" => ["The name has already been taken."]
        ]);
    }


    /** @test */
    public function update_failed_category_with_fields_no_changed() {

        $category = factory(Category::class)->create();

        $this->actingAs(self::$user);
        $this->json('PUT', '/api/category/'.$category->id, $category->toArray());

        $this->seeStatusCode(400);
        $this->seeJson([
            "message" => "Nothing to change."
        ]);
    }

    /** @test */
    public function delete_failed_unauthorized() {

        $this->json('DELETE', '/api/category/'.rand(1,100), []);

        $this->seeStatusCode(401);
        $this->assertEquals("Unauthorized.", $this->response->getContent());
    }

    /** @test */
    public function delete_failed_category_with_invalid_id() {

        $this->actingAs(self::$user);
        $this->json('DELETE', '/api/category/'.rand(1,100), []);

        $this->seeStatusCode(404);
        $this->seeJson([
            "message" => "Not found."
        ]);
    }

    /** @test */
    public function delete_success_category_with_valid_id() {

        $category = factory(Category::class)->create();

        $this->actingAs(self::$user);
        $this->json('DELETE', '/api/category/'.$category->id);

        $this->seeStatusCode(200);

        $this->seeJson([
            "message" => "success"
        ]);

        $this->seeInDatabase('categories', ['id' => $category->id]);
    }
}