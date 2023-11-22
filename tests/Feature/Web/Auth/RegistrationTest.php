<?php

namespace Tests\Feature\Web\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response
            ->assertSeeVolt('pages.auth.register')
            ->assertOk();
    }

    public function test_new_users_can_register(): void
    {
        $component = Volt::test('pages.auth.register')
            ->set('name', 'Test User')
            ->set('email', 'test@example.com')
            ->set('password', 'password')
            ->set('password_confirmation', 'password');

        $component->call('register');

        $component->assertRedirect(RouteServiceProvider::HOME);

        $this->assertAuthenticated();
    }

    public function test_it_throws_error_if_email_already_exists(): void
    {
        User::factory()->create([
            'email' => 'test@example.com'
        ]);

        $component = Volt::test('pages.auth.register')
            ->set('name', 'Test User')
            ->set('email', 'test@example.com')
            ->set('password', 'password')
            ->set('password_confirmation', 'password');

        $component->call('register');

        $component->assertHasErrors(['email']);
    }

    public function test_it_throws_error_if_required_parameters_are_not_set(): void
    {
        User::factory()->create([
            'email' => 'test@example.com'
        ]);

        $component = Volt::test('pages.auth.register')
            ->call('register');

        $component->assertHasErrors(['name', 'email', 'password']);
    }
}
