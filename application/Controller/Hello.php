<?php
/**
 * @Description:
 * @Author: chenqinghe
 * @Date: 2017/11/13
 * @Time: 16:34
 */

namespace App\Controller;

use Swoole\Http\Request;
use Swolf\Component\Http\Response\Response;

class Hello
{

    public function sayHello(Request $request)
    {
        $name = $request->post['name'];

        return new Response(0, 'hello:' . $name, 'ok');
    }


}