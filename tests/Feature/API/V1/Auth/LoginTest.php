<?php

namespace Tests\Feature\API\V1;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        User::factory()->create([
            'email' => 'test_user@qati3.com'
        ]);
    }

    public function test_user_can_login_with_email_and_password(): void
    {
        $this->post(route('api.v1.login'), [
            'email' => 'test_user@qati3.com',
            'password' => 'password',
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

    public function test_it_throws_validation_error_if_email_or_password_fields_are_not_found(): void
    {
        $this->post(route('api.v1.login'), [
            'email' => null,
            'password' => null,
        ])->assertStatus(422);
    }

    public function test_it_throws_validation_error_if_email_doesnt_exist(): void
    {
        $this->post(route('api.v1.login'), [
            'email' => 'wrong_email@gmail.com',
            'password' => 'password',
        ])->assertStatus(422);
    }

    public function test_it_throws_validation_error_if_password_is_incorrect(): void
    {
        $this->post(route('api.v1.login'), [
            'email' => 'test_user@qati3.com',
            'password' => 'incorrect_password',
        ])->assertStatus(422);
    }
}
