<?php
/**
 * @Description:
 * @Author: chenchao
 * @Date: 2017/11/13
 * @Time: 16:54
 */

namespace Swolf\Component\Middleware;

use Swoole\Http\Request;
use Swoole\Http\Response;

interface Middleware
{
    /**
     * @param Request $request
     * @param Response $response
     * @param \Closure $next
     * @return bool
     */
    public function handle(Request $request, Response $response, \Closure $next);

}