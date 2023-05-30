<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IpLimit
{
    protected  $ip = [
        '127.0.0.1'
    ];

    public function handle(Request $request, Closure $next)
    {
        $clientIp = $request->getClientIp();
        if (in_array($clientIp, $this->ip)) {
            // ip 白名单
            return $next($request);
        } else {
            # 返回自定义json
            $request->headers->set('Accept', 'application/json');
            return response()->json(['code' => 200, 'msg' => '无权访问', 'ip' => $clientIp]);
        }
    }
}
