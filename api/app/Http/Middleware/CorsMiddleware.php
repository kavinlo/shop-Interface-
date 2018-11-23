<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
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
        $response = $next($request);
        $origin = $request->server('HTTP_ORIGIN') ? $request->server('HTTP_ORIGIN') : '';
        // 允许访问的域名列表
        $allow_origin = [
            'http://localhost:8080',
        ];
        // 通过 $response->header 设置协议头
        // (扩展：如果想要允许所有域名跨域访问，就可以去掉if判断，然后
        // 	    直接设置 Access-Control-Allow-Origin : *)
        if (in_array($origin, $allow_origin)) {
            // 如果要允许所有域名跨域访问，设置把这一项设置为 *
            $response->header('Access-Control-Allow-Origin', $origin);
            $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, DELETE, OPTIONS');
            $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie, X-CSRF-TOKEN, Accept, Authorization, X-XSRF-TOKEN');
            $response->header('Access-Control-Expose-Headers', 'Authorization, authenticated');
            $response->header('Access-Control-Allow-Credentials', 'true');
        }
        return $next($request);
    }
}
