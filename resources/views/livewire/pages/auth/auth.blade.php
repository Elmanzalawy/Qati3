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

}
?>


<div id="hero-section">
    <div id="hero-section-content-wrapper" class="container">
        <form wire:submit="login">
            <div class="text-center mb-5">
                <img height="60" src="{{ asset('assets/images/qati3-logo.svg') }}" alt="">
            </div>
            <h1 class="my-4 text-center text-primary bold">{{ __('Log in to your account') }}</h1>
            <div class="row d-flex justify-content-center">
                <a href="{{ route('login') }}" class="col-12 col-sm-6 col-lg-5 bold btn btn-lg btn-primary my-3">{{ __('Log in with email and password') }}</a>
            </div>

            <div class="row d-flex justify-content-center">
                <a href="{{ route('auth.social_redirect', 'google') }}" class="col-12 col-sm-6 col-lg-5 bold btn btn-lg btn-outline-primary my-3">{{ __('Continue with Google') }}</a>
            </div>

            <div class="row d-flex justify-content-center">
                <a href="{{ route('auth.social_redirect', 'facebook') }}" class="col-12 col-sm-6 col-lg-5 bold btn btn-lg btn-outline-primary my-3">{{ __('Continue with Facebook') }}</a>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-12 col-sm-6 col-lg-5 d-flex p-0">
                    <span>Don't have an account?</span>
                    <a class="ms-2" href="{{ route('register') }}">Register</a>
                </div>
            </div>

        </form>
    </div>
</div>
