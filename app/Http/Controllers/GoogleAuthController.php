<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;
use Symfony\Component\HttpFoundation\RedirectResponse;

class GoogleAuthController extends Controller
{
    /**
     * Redirects to Google OAuth when user is not authenticated
     *
     * @return RedirectResponse
     */
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Gets callback from Google then makes a decision whether to authenticate user
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                Auth::login($user);
            } else {
                $newUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make(Str::random(10)),
                    'profile_photo_path' => $googleUser->avatar,
                ]);
                Auth::login($newUser);
            }

            if (!$user && !$newUser) {
                $email = $googleUser->email;
                throw new Exception("$email login error", 500);
            }

        } catch (Exception $e) {
            if ($e->getCode() !== 0) {
                Log::channel('auth')->error($e->getMessage());
            }
        }

        return redirect()->intended('dashboard');
    }
}

