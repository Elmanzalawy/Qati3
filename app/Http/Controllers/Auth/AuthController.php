<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    protected const SOCIALITE_PROVIDERS = [
        'google',
        'facebook',
        'apple'
    ];

    public function logout(Request $request)
    {
        auth()->guard('web')->logout();

        session()->invalidate();
        session()->regenerateToken();

        return redirect('/');
    }

    public function socialiteRedirect(Request $request, $provider)
    {
        if (!in_array($provider, self::SOCIALITE_PROVIDERS)) {
            return back()->with('error', 'Invalid provider.');
        }

        return Socialite::driver($provider)->redirect();
    }

    public function socialiteCallback(Request $request, $provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            $now = now()->toDateTimeString();

            $insert_data = [
                'provider'      => $provider,
                'name'          => $socialUser->name,
                'password'      => bcrypt($socialUser->getId()),
                'avatar' => $socialUser->avatar,
                'locale' => $socialUser->user['locale'],
                'email_verified_at' => $now,
                'last_login_at' => $now,
            ];

            $user = User::query()->updateOrCreate(['email' => $socialUser->email], $insert_data);
            Auth::login($user);

            return redirect()->route('index');
        } catch (\Exception $e) {
            Log::error('Socialite authentication error: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
