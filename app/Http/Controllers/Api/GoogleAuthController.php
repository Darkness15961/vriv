<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Register User
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => null // Google users don't have password initially
                ]);
            } else {
                // Update google_id if it's missing
                if (empty($user->google_id)) {
                    $user->update([
                        'google_id' => $googleUser->getId()
                    ]);
                }
            }

            $token = Auth::guard('api')->login($user);

            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => Auth::guard('api')->factory()->getTTL() * 60,
                'user' => $user
            ]);

        } catch (Exception $e) {
            return response()->json(['error' => 'Google Authentication Failed', 'message' => $e->getMessage()], 401);
        }
    }
}
