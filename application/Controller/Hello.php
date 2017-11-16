<?php
/**
 * @Description:
 * @Author: chenchao
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
        $size = $request->post['size'];

        $sum = 0;
        for ($i = 0; $i < $size; $i++) {
            $sum += 3;
        }
        return new Response(0, $sum, 'ok');
    }


}