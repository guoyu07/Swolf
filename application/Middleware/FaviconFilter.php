<?php
/**
 * @Description:
 * @Author: chenchao
 * @Date: 2017/11/13
 * @Time: 18:19
 */

namespace App\Middleware;

use Swolf\Component\Middleware\Middleware;
use Swoole\Http\Request;
use Swoole\Http\Response;

class FaviconFilter implements Middleware
{
    public function handle(Request $request, Response $response, \Closure $next)
    {
//        echo 'favicon' . "\n";
        if ($request->server['request_uri'] == '/favicon.ico') {
            $response->status(404);
            $response->end();
            return;
        }
        return $next($request, $response);
    }
}