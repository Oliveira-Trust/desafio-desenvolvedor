<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Status;

class StatusApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_status()
    {
        $status = factory(Status::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/statuses', $status
        );

        $this->assertApiResponse($status);
    }

    /**
     * @test
     */
    public function test_read_status()
    {
        $status = factory(Status::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/statuses/'.$status->id
        );

        $this->assertApiResponse($status->toArray());
    }

    /**
     * @test
     */
    public function test_update_status()
    {
        $status = factory(Status::class)->create();
        $editedStatus = factory(Status::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/statuses/'.$status->id,
            $editedStatus
        );

        $this->assertApiResponse($editedStatus);
    }

    /**
     * @test
     */
    public function test_delete_status()
    {
        $status = factory(Status::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/statuses/'.$status->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/statuses/'.$status->id
        );

        $this->response->assertStatus(404);
    }
}
