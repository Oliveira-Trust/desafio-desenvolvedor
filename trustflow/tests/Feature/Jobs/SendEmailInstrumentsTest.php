<?php

namespace Tests\Feature\Jobs;

use App\Jobs\SendEmailInstrumentsJob;
use App\Mail\InstrumentImportFailed;
use App\Mail\InstrumentImportFinished;
use App\Models\UploadHistory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SendEmailInstrumentsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_if_an_error_is_received_it_sends_a_failure_message(): void
    {
        Mail::fake();
        $user = User::factory()->create([
            "email" => "email@test.com",
            "password" => "password"
        ]);
        $errorMessage = "Critical error processing line 500";

        $history = UploadHistory::factory()->create([
            'user_id' => $user->id
        ]);
        
        $job = new SendEmailInstrumentsJob($history, $errorMessage);
        $job->handle();

        Mail::assertSent(InstrumentImportFailed::class, function($mail) use ($user, $errorMessage){
            return $mail->hasTo($user->email) && $mail->errorMessage === $errorMessage;
        });
    }

    public function test_it_sends_success_email_when_no_error_is_present(): void
    {
        Mail::fake();
        $user = User::factory()->create([
            "email" => "email@test.com",
            "password" => "password"
        ]);

        $history = UploadHistory::factory()->create([
            'user_id' => $user->id
        ]);
        
        $job = new SendEmailInstrumentsJob($history, null);
        $job->handle();

        Mail::assertSent(InstrumentImportFinished::class, function($mail) use ($user){
            return $mail->hasTo($user->email);
        });

        Mail::assertNotSent(InstrumentImportFailed::class);
    }
}
