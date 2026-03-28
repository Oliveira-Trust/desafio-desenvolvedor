<?php

namespace Tests\Feature\Services;

use App\Services\InstrumentsService;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Tests\TestCase;

class InstrumentServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_it_throws_exception_if_file_header_is_invalid(): void
    {
        Storage::fake('uploads');

        $cvsContent = "teste\n";
        $cvsContent .= "Kxltd;SIgdj;Pmej\n";

        $file = UploadedFile::fake()->createWithContent('test.csv', $cvsContent);
        $service = new InstrumentsService($file, '2026-03-22');
        
        $this->assertInstanceOf(Exception::class, new Exception);
        $this->expectExceptionMessage("Invalid file: column header not found on line 2.");
        
        $service->saveFile();
    }

    public function test_throw_an_exception_if_the_data_provided_does_not_match_the_data_in_the_file()
    {
        Storage::fake('uploads');

        $cvsContent = "teste\n";
        $cvsContent .= "RptDt;TckrSymb;ExrcPric;ReqrdConvsInd\n";
        $cvsContent .= "2024-03-23;PETR4;58,95;S\n";
        $cvsContent .= "9999-12-31;VALE3;10,00;N";

        $file = UploadedFile::fake()->createWithContent('test.csv', $cvsContent);
        $service = new InstrumentsService($file, '2026-03-22');
        
        $this->assertInstanceOf(Exception::class, new Exception);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage("Date mismatch: File is for 2024-03-23, but reference date is 2026-03-22");
        
        $service->saveFile();
    }
}
