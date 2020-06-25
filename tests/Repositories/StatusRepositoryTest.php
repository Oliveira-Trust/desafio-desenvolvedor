<?php namespace Tests\Repositories;

use App\Models\Status;
use App\Repositories\StatusRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StatusRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StatusRepository
     */
    protected $statusRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->statusRepo = \App::make(StatusRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_status()
    {
        $status = factory(Status::class)->make()->toArray();

        $createdStatus = $this->statusRepo->create($status);

        $createdStatus = $createdStatus->toArray();
        $this->assertArrayHasKey('id', $createdStatus);
        $this->assertNotNull($createdStatus['id'], 'Created Status must have id specified');
        $this->assertNotNull(Status::find($createdStatus['id']), 'Status with given id must be in DB');
        $this->assertModelData($status, $createdStatus);
    }

    /**
     * @test read
     */
    public function test_read_status()
    {
        $status = factory(Status::class)->create();

        $dbStatus = $this->statusRepo->find($status->id);

        $dbStatus = $dbStatus->toArray();
        $this->assertModelData($status->toArray(), $dbStatus);
    }

    /**
     * @test update
     */
    public function test_update_status()
    {
        $status = factory(Status::class)->create();
        $fakeStatus = factory(Status::class)->make()->toArray();

        $updatedStatus = $this->statusRepo->update($fakeStatus, $status->id);

        $this->assertModelData($fakeStatus, $updatedStatus->toArray());
        $dbStatus = $this->statusRepo->find($status->id);
        $this->assertModelData($fakeStatus, $dbStatus->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_status()
    {
        $status = factory(Status::class)->create();

        $resp = $this->statusRepo->delete($status->id);

        $this->assertTrue($resp);
        $this->assertNull(Status::find($status->id), 'Status should not exist in DB');
    }
}
