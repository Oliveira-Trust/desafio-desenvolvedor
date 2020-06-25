<?php namespace Tests\Repositories;

use App\Models\Client;
use App\Repositories\ClientRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ClientRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ClientRepository
     */
    protected $clientRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->clientRepo = \App::make(ClientRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_client()
    {
        $client = factory(Client::class)->make()->toArray();

        $createdClient = $this->clientRepo->create($client);

        $createdClient = $createdClient->toArray();
        $this->assertArrayHasKey('id', $createdClient);
        $this->assertNotNull($createdClient['id'], 'Created Client must have id specified');
        $this->assertNotNull(Client::find($createdClient['id']), 'Client with given id must be in DB');
        $this->assertModelData($client, $createdClient);
    }

    /**
     * @test read
     */
    public function test_read_client()
    {
        $client = factory(Client::class)->create();

        $dbClient = $this->clientRepo->find($client->id);

        $dbClient = $dbClient->toArray();
        $this->assertModelData($client->toArray(), $dbClient);
    }

    /**
     * @test update
     */
    public function test_update_client()
    {
        $client = factory(Client::class)->create();
        $fakeClient = factory(Client::class)->make()->toArray();

        $updatedClient = $this->clientRepo->update($fakeClient, $client->id);

        $this->assertModelData($fakeClient, $updatedClient->toArray());
        $dbClient = $this->clientRepo->find($client->id);
        $this->assertModelData($fakeClient, $dbClient->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_client()
    {
        $client = factory(Client::class)->create();

        $resp = $this->clientRepo->delete($client->id);

        $this->assertTrue($resp);
        $this->assertNull(Client::find($client->id), 'Client should not exist in DB');
    }
}
