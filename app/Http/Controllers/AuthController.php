<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\{Response as ResponseFacade, Auth, Log};
use Illuminate\Http\{Response, JsonResponse};

/**
 * Handles incoming requests related to user authentication.
 *
 * @author PHP-Open-Source-Saver <https://github.com/PHP-Open-Source-Saver/jwt-auth>
 * @see Controller
 */
class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        $token = Auth::attempt($credentials);

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = Auth::user();
        return response()->json($user);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): JsonResponse
    {
        if (Auth::user()) {
            Auth::logout();
            return ResponseFacade::json([], Response::HTTP_NO_CONTENT);
        }

        return ResponseFacade::json([], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $refreshToken = Auth::refresh();
        return $this->respondWithToken($refreshToken);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}
