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
     * Redirigir al usuario a la página de autenticación de Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Obtener la información del usuario de Google.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Registrar Usuario
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => null // Los usuarios de Google no tienen contraseña inicialmente
                ]);
            } else {
                // Actualizar google_id si falta
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
            return response()->json(['error' => 'Fallo en Autenticación con Google', 'message' => $e->getMessage()], 401);
        }
    }
}
