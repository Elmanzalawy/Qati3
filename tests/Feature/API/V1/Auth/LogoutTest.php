<?php

namespace Tests\Feature\API\V1;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        User::factory()->create([
            'email' => 'test_user@qati3.com'
        ]);
    }

    public function test_a_registered_user_can_logout(): void
    {
        $this->actingAs(User::first());

        $this->post(
            route('api.v1.logout')
        )->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data',
                'errors',
                'meta',
            ]);

        // assert user tokens are revoked
        $this->assertEquals(0, DB::table('personal_access_tokens')->count());
    }

    public function test_it_throws_unauthorized_error_if_user_is_not_authenticated(): void
    {
        $this->post(
            route('api.v1.logout')
        )->assertStatus(401);
    }
}
