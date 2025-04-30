<?php

namespace Tests\Feature;

use App\Models\User;
use App\Repositories\MongoDbDataRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;
use Mockery;

class DataSearchApiTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $token;
    protected $mockRepository;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        $this->token = $this->user->createToken('test-token')->plainTextToken;
        
        Cache::flush();
        
        $this->mockRepository = Mockery::mock(MongoDbDataRepository::class);
        $this->app->instance(MongoDbDataRepository::class, $this->mockRepository);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testSearchEndpointWithoutAuth()
    {
        $response = $this->getJson('/api/v1/data?TckrSymb=AAPL');
        
        $response->assertStatus(401);
    }

    public function testSearchEndpointWithFilters()
    {
        $this->mockRepository->shouldReceive('search')
            ->with('AAPL', '2023-01-01', 50, 0)
            ->once()
            ->andReturn([
                'data' => [
                    [
                        'RptDt' => '2023-01-01',
                        'TckrSymb' => 'AAPL',
                        'MktNm' => 'NASDAQ',
                        'SctyCtgyNm' => 'Equity',
                        'ISIN' => 'US0378331005',
                        'CrpnNm' => 'Apple Inc.'
                    ]
                ],
                'total' => 1,
                'page' => 1,
                'limit' => 50
            ]);
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->getJson('/api/v1/data?TckrSymb=AAPL&RptDt=2023-01-01');
        
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data',
                'meta' => [
                    'current_page',
                    'per_page', 
                    'total',
                    'last_page'
                ]
            ]);
            
        $response->assertJsonPath('data.0.CrpnNm', 'Apple Inc.');
        $response->assertJsonPath('meta.total', 1);
    }

    public function testSearchEndpointCaching()
    {
        $this->mockRepository->shouldReceive('search')
            ->with('MSFT', null, 50, 0)
            ->once()
            ->andReturn([
                'data' => [
                    [
                        'RptDt' => '2023-01-01',
                        'TckrSymb' => 'MSFT',
                        'MktNm' => 'NASDAQ',
                        'SctyCtgyNm' => 'Equity',
                        'ISIN' => 'US5949181045',
                        'CrpnNm' => 'Microsoft Corporation'
                    ]
                ],
                'total' => 1,
                'page' => 1,
                'limit' => 50
            ]);
        
        $response1 = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->getJson('/api/v1/data?TckrSymb=MSFT');
        
        $response1->assertStatus(200);
        
        $response2 = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->getJson('/api/v1/data?TckrSymb=MSFT');
        
        $response2->assertStatus(200);
        $response2->assertJsonPath('data.0.CrpnNm', 'Microsoft Corporation');
        
    }
} 