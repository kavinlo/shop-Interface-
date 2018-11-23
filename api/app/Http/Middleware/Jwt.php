<?php

namespace App\Http\Middleware;
use \Firebase\JWT\JWT as JWTCHECK;
use Closure;

class Jwt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $jwt = substr($request->server('HTTP_AUTHORIZATION'), 7);
        try {
            $request->jwt = JWTCHECK::decode($jwt, env('JWT_KEY'), array('HS256'));
            return $next($request);
        } catch (\Exception $e) {
            return response([
                'code' => '403',
                'message' => 'HTTP/1.1 403 Forbidden'
            ]);
        }

    }
}
