<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticateJWT
{
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        try {
            $credentials = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        } catch (ExpiredException $e) {
            return response()->json(['error' => 'Provided token is expired'], 400);
        } catch (Exception $e) {
            \Log::error('Error decoding token: ' . $e->getMessage());
            return response()->json(['error' => 'An error while decoding token'], 400);
        }

        $user = User::find($credentials->sub);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        Auth::login($user);

        return $next($request);
    }
}
