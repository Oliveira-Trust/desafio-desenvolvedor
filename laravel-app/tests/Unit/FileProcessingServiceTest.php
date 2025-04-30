<?php

namespace Tests\Unit;

use App\Models\Upload;
use App\Repositories\MongoDbDataRepository;
use App\Services\FileProcessingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use Tests\TestCase;

class FileProcessingServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $service;
    protected $repositoryMock;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->repositoryMock = $this->createMock(MongoDbDataRepository::class);
        
        $this->service = new FileProcessingService($this->repositoryMock);
        
        Storage::fake('uploads');
    }

    public function testProcessCsvFile()
    {
        $csvContent = "RptDt,TckrSymb,MktNm,SctyCtgyNm,ISIN,CrpnNm\n";
        $csvContent .= "2023-01-01,AAPL,NASDAQ,Equity,US0378331005,Apple Inc.\n";
        $csvContent .= "2023-01-01,MSFT,NASDAQ,Equity,US5949181045,Microsoft Corporation\n";
        
        $fileName = 'test_file.csv';
        Storage::disk('uploads')->put($fileName, $csvContent);
        $filePath = Storage::disk('uploads')->path($fileName);
        
        $upload = Upload::factory()->create([
            'file_name' => $fileName,
            'file_path' => $fileName,
            'status' => 'pending',
        ]);
        
        $data = $this->service->processFile($upload);
        
        $this->assertCount(2, $data);
        $this->assertEquals('AAPL', $data[0]['TckrSymb']);
        $this->assertEquals('Microsoft Corporation', $data[1]['CrpnNm']);
    }

    public function testHandleInvalidFile()
    {
        $upload = Upload::factory()->create([
            'file_name' => 'non_existent.csv',
            'file_path' => 'non_existent.csv',
            'status' => 'pending',
        ]);
        
        $this->expectException(\Exception::class);
        
        $this->service->processFile($upload);
    }
} 