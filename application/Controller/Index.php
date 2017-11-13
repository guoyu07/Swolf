<?php
/**
 * @Description:
 * @Author: chenchao
 * @Date: 2017/11/13
 * @Time: 16:34
 */

namespace App\Controller;

use Swoole\Http\Request;
use Swoole\Http\Response;

class Index
{

    public function index(Request $request, Response $response)
    {
        $name = $request->get['name'];

        $response->end('hello, ' . $name);
    }


}