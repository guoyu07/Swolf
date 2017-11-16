<?php
/**
 * @Description:
 * @Author: chenchao
 * @Date: 2017/11/13
 * @Time: 17:05
 */

namespace App\Middleware;

use Swolf\Component\Middleware\Middleware;
use Swoole\Http\Request;
use Swoole\Http\Response;

class JwtAuth implements Middleware
{
    public function handle(Request $request, Response $response, \Closure $next)
    {
//        echo 'jwt'."\n";
        return $next($request, $response);
    }
}