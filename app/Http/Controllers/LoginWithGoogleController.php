<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginWithGoogleController extends Controller
{
    /**
     * Redirect to Google Consent Screen
     */
    public function redirectToGoogle(): \Symfony\Component\HttpFoundation\RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Register/Login User from google callback
     */
    public function handleGoogleCallback(): RedirectResponse
    {
        try {
            $user = Socialite::driver('google')->user();

            $finduser = User::whereGoogleId($user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => Hash::make($user->email . rand(0,9999))
                ]);

                Auth::login($newUser);
            }

            return redirect()->intended(RouteServiceProvider::HOME);
        } catch (Exception $e) {
            return redirect()->route('login');
        }
    }
}
