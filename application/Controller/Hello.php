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

class Hello
{

    public function sayHello(Request $request, Response $response)
    {
        $name = $request->get['name'];

        $response->end('hello, ' . $name);
    }


}