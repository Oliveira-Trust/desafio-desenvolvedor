<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Http\Livewire\UpdatePasswordForm;
use Livewire\Livewire;
use Tests\TestCase;

class UpdatePasswordTest extends TestCase
{
    use RefreshDatabase;

    public function test_password_can_be_updated(): void
    {
        $this->actingAs($user = User::factory()->create(),'web');

        Livewire::test(UpdatePasswordForm::class)
            ->set('state', [
                'current_password' => 'password!@#$123456',
                'password' => 'new-password!@#$654321',
                'password_confirmation' => 'new-password!@#$654321',
            ])
            ->call('updatePassword');

        $this->assertTrue(Hash::check('new-password!@#$654321', $user->fresh()->password));
    }

    public function test_current_password_must_be_correct(): void
    {
        $this->actingAs($user = User::factory()->create(),'web');

        Livewire::test(UpdatePasswordForm::class)
            ->set('state', [
                'current_password' => 'wrong-password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ])
            ->call('updatePassword')
            ->assertHasErrors(['current_password']);

        $this->assertTrue(Hash::check('password!@#$123456', $user->fresh()->password));
    }

    public function test_new_passwords_must_match(): void
    {
        $this->actingAs($user = User::factory()->create(),'web');

        Livewire::test(UpdatePasswordForm::class)
            ->set('state', [
                'current_password' => 'password!@#$123456',
                'password' => 'new-password',
                'password_confirmation' => 'wrong-password',
            ])
            ->call('updatePassword')
            ->assertHasErrors(['password']);

        $this->assertTrue(Hash::check('password!@#$123456', $user->fresh()->password));
    }
}
