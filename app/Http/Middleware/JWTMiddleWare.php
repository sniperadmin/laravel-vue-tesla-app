<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleWare extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json([
                    'status' => 'error',
                    'authorization' => 'invalid token',
                ], 403);
            } else if ($e instanceof Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json([
                    'status' => 'error',
                    'authorization' => 'Token has Expired',
                ], 401);
            } else if ($e instanceof Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
                return response()->json([
                    'status' => 'error',
                    'authorization' => 'token is blacklisted!
                    ', ], 401);
            } else if ($e instanceof Tymon\JWTAuth\Exceptions\JWTException) {
                return response()->json([
                    'status' => 'error',
                    'authorization' => 'missing token to be parsed',
                ], 401);
            } else {
                return response()->json([
                    'status' => 'error',
                    'authorization' => 'auth token not found',
                ], 401);
            }
        }
        return $next($request);
    }
}
