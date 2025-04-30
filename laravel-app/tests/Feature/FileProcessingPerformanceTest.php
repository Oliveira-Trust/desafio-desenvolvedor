<?php

namespace Tests\Feature;

use App\Models\Upload;
use App\Services\FileProcessingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Support\Str;

class FileProcessingPerformanceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('uploads');
    }
    
    /**
     * Test file processing performance with a large file.
     * 
     * @group performance
     */
    public function testLargeFileProcessingPerformance()
    {
        if (!getenv('RUN_PERFORMANCE_TESTS')) {
            $this->markTestSkipped('Performance tests are skipped by default. Set RUN_PERFORMANCE_TESTS=1 to run them.');
        }
        
        $path = Storage::disk('uploads')->path('large_test_file.csv');
        $file = fopen($path, 'w');
        
        fputcsv($file, ['RptDt', 'TckrSymb', 'MktNm', 'SctyCtgyNm', 'ISIN', 'CrpnNm']);
        
        for ($i = 0; $i < 10000; $i++) {
            fputcsv($file, [
                date('Y-m-d'),                   
                'TKR' . $i,                      
                'MARKET' . ($i % 5),             
                'CATEGORY' . ($i % 3),           
                'ISIN' . Str::random(12),        
                'Company Name ' . $i,            
            ]);
        }
        
        fclose($file);
        
        $upload = Upload::factory()->create([
            'file_name' => 'large_test_file.csv',
            'file_path' => $path,
            'status' => 'pending',
        ]);
        
        $startTime = microtime(true);
        
        $repositoryMock = $this->mock(MongoDbDataRepository::class);
        $repositoryMock->shouldReceive('bulkInsert')->andReturn(true);
        
        $service = new FileProcessingService($repositoryMock);
        $data = $service->processFile($upload);
        
        $endTime = microtime(true);
        $processingTime = $endTime - $startTime;
        
        
        $this->assertLessThan(5.0, $processingTime, "File processing took {$processingTime} seconds, which exceeds the 5 second threshold");
        
        $this->assertCount(10000, $data);
    }
} 