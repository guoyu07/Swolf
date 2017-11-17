<?php
/**
 * @Description:
 * @Author: chenqinghe
 * @Date: 2017/11/13
 * @Time: 18:19
 */

namespace App\Middleware;

use Swolf\Component\Http\Middleware\MiddlewareInterface;
use Swoole\Http\Request;
use Swoole\Http\Response;

class FaviconFilter implements MiddlewareInterface
{
    public function handle(Request $request, Response $response, \Closure $next)
    {
        if ($request->server['request_uri'] == '/favicon.ico') {
            $response->status(404);
            $response->end();
            return false;
        }
        return $next($request, $response);
    }
}