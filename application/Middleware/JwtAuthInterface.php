<?php
/**
 * @Description:
 * @Author: chenqinghe
 * @Date: 2017/11/13
 * @Time: 17:05
 */

namespace App\Middleware;

use Swolf\Component\Http\Middleware\MiddlewareInterface;
use Swoole\Http\Request;
use Swoole\Http\Response;

class JwtAuth implements MiddlewareInterface
{
    public function handle(Request $request, Response $response, \Closure $next)
    {
        return $next($request, $response);
    }
}