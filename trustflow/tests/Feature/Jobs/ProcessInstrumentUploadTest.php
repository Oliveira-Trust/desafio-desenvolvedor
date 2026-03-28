<?php

namespace Tests\Feature\Jobs;

use App\Jobs\ProcessInstrumentUpload;
use App\Models\Instrument;
use App\Models\UploadHistory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProcessInstrumentUploadTest extends TestCase
{
    use RefreshDatabase;  
    
    private function createUser(array $overrides = [])
    {
        return User::factory()->create([
            'email' => 'email@teste.com',
            'password' => bcrypt('password')
        ]);
        
    }

    public function test_it_processes_csv_upload_correctly(): void
    {
        Storage::fake('local');
        $user = $this->createUser();
        
        $history = UploadHistory::create([
            'user_id' => $user->id,
            'file_name' => 'test_instruments.csv',
            'file_hash' => md5('filename_original_fake'),
            'status' => 'pending',
            'reference_date' => now()
        ]);

        $path = "uploads/test_instruments.csv";
        $cvsContent = "RptDt;TckrSymb;ExrcPric;ReqrdConvsInd\n";
        $cvsContent .= "2024-03-23;PETR4;58,95;S\n";
        $cvsContent .= "9999-12-31;VALE3;10,00;N";

        Storage::disk('local')->put($path, $cvsContent);

        $job = new ProcessInstrumentUpload($history, $path);
        $job->handle();

        $this->assertEquals(2, Instrument::count());
        $this->assertDatabaseHas('instruments', [
            'TckrSymb' => 'PETR4',
            'ExrcPric' => 58.95,
            'upload_history_id' => $history->id
        ]);

        $this->assertDatabaseHas('instruments', [
            'TckrSymb' => 'VALE3',
            'RptDt' => '9999-12-31', 
        ]);

        $this->assertEquals('completed', $history->fresh()->status);
        Storage::disk('local')->assertExists($path);
    }
}
