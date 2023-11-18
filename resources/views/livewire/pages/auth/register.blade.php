<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        auth()->login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div id="hero-section">
    <div id="hero-section-content-wrapper" class="container">

        <form wire:submit="register">
            <h1 class="mb-5 text-center text-primary bold">{{ __('Register') }}</h1>
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-md-6">
                    <x-input id="name" text="{{ __('Name') }}" type="name" name="name" required autofocus autocomplete="username" wire:model="name" placeholder="name"></x-input>

                    <x-input id="email" text="{{ __('Email') }}" type="email" name="email" required autocomplete="email" wire:model="email" placeholder="name@example.com"></x-input>

                    <x-input id="password" text="{{ __('password') }}" type="password" name="password" required autocomplete="new-password" wire:model="password" placeholder="password"></x-input>

                    <x-input id="password_confirmation" text="{{ __('Confirm Password') }}" type="password" name="password_confirmation" required autocomplete="new-password" wire:model="password_confirmation" placeholder="password_confirmation"></x-input>

                    <button class="btn btn-primary" >{{ __('Register') }}</button>

                    @if (Route::has('password.request'))
                        <a class="ms-2" href="{{ route('password.request') }}" wire:navigate>
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
