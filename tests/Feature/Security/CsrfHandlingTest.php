<?php

namespace Tests\Feature\Security;

use App\Shared\Errors\ErrorCode;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

class CsrfHandlingTest extends TestCase
{
    public function test_api_returns_structured_419_payload_for_csrf_mismatch(): void
    {
        Route::post('/api/test-csrf-mismatch', static function (): never {
            throw new HttpException(419, 'CSRF token mismatch.');
        });

        $response = $this->withHeader('Accept', 'application/json')
            ->postJson('/api/test-csrf-mismatch');

        $response->assertStatus(419);
        $response->assertJsonPath('error.code', ErrorCode::AUTH_CSRF_MISMATCH);
        $response->assertJsonPath('error.message', 'CSRF token mismatch.');
    }
}
