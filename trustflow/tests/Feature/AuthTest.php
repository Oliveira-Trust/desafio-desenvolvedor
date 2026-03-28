<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    private function createUserCredentials(array $overrides = [])
    {
        $password = 'password123';
        $user = User::factory()->create([
            'email' => 'email@teste.com',
            'password' => bcrypt($password)
        ]);

        return [$user, $password];
    }

    public static function invalidLoginProvider(): array
    {
        return [
            'senha_incorreta' => ['existe@teste.com', 'senha_errada', 403],
            'email_inexistente' => ['nao_existe@teste.com', '123456', 403],
            'email_vazio' => ['', '123456', 422],
            'senha_vazia' => ['existe@teste.com', '', 422],
        ];
    }

    public function test_user_can_login_with_valid_credential(): void
    {
        [$user, $password] = $this->createUserCredentials();

        $response = $this->postJson('/api/v1/login', [
            "email" => $user->email,
            'password' => $password
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message', 'token'
            ]);
        
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_log_in_with_invalid_credentials(): void
    {
        [$user] = $this->createUserCredentials();

        $response = $this->postJson('/api/v1/login', [
            "email" => $user->email,
            'password' => '123'
        ]);

        $response->assertStatus(403);        
    }


    #[DataProvider('invalidLoginProvider')]
    public function test_login_validation_rules($email, $password, $expectedStatus)
    {
        User::factory()->create(['email' => 'existe@teste.com', 'password' => bcrypt('123456')]);
        $response = $this->postJson('/api/v1/login', [
            'email' => $email,
            'password' => $password
        ]);

        $response->assertStatus($expectedStatus);
    }

    public function test_user_can_logout(): void
    {
        [$user] = $this->createUserCredentials();

        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders(["Authorization" => "Bearer $token"])
                        ->postJson('/api/v1/logout');
        
        $response->assertStatus(200)
                    ->assertJson([
                        'message' => 'Logged out successfully'
                    ]);
    }

}
