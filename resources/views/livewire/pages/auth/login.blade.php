<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component
{
    #[Rule(['required', 'string', 'email'])]
    public string $email = '';

    #[Rule(['required', 'string'])]
    public string $password = '';

    #[Rule(['boolean'])]
    public bool $remember = false;

    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! auth()->attempt($this->only(['email', 'password'], $this->remember))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());

        session()->regenerate();

        $this->redirect(
            session('url.intended', RouteServiceProvider::HOME),
            navigate: true
        );
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}; ?>


<div id="hero-section">
    <div id="hero-section-content-wrapper" class="container">
        <form wire:submit="login">
            <h1 class="mb-5 text-center text-primary bold">Login</h1>
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-md-6">
                    <x-input id="email" name="email" type="email" text="{{ __('Email') }}" required autofocus autocomplete="username" wire:model="email" placeholder="name@example.com"></x-input>

                    <x-input id="password" name="password" type="password" text="{{ __('Password') }}" required autocomplete="current-password" wire:model="password" placeholder="Password"></x-input>

                    <x-checkbox wire:model="remember" name="remember" id="remember" text="{{ __('Remember me') }}"></x-checkbox>

                    <button class="btn btn-primary" >{{ __('Log in') }}</button>

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
