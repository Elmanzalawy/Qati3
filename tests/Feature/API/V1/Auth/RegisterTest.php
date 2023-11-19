<?php

namespace Tests\Feature\API\V1;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_user_can_register_with_email_and_password(): void
    {
        $this->post(route('api.v1.register'), [
            'name' => 'Test User',
            'email' => 'test_user@qati3.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ])->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'token'
                ],
                'errors',
                'meta',
            ]);
    }

    public function test_it_throws_validation_error_if_required_parameters_are_missing()
    {
        $this->post(route('api.v1.register'), [
            'name' => null,
            'email' => null,
            'password' => null,
            'password_confirmation' => null,
        ])
            ->assertJsonValidationErrors(['name', 'email', 'password'])
            ->assertStatus(422);
    }

    public function test_it_throws_validation_error_if_password_confirmation_does_not_match()
    {
        $this->post(route('api.v1.register'), [
            'name' => 'Test User',
            'email' => 'test_user@qati3.com',
            'password' => 'password',
            'password_confirmation' => 'incorrect_password',
        ])->assertStatus(422);
    }

    public function test_it_throws_validation_error_if_email_already_exists()
    {
        User::factory()->create([
            'email' => 'test_user@qati3.com'
        ]);

        $this->post(route('api.v1.register'), [
            'name' => 'Test User',
            'email' => 'test_user@qati3.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ])->assertStatus(422);
    }
}
