<?php

namespace App\Service;

use Swoole\Http\Request;
use Swolf\Component\Http\Response\Response;

class Hello
{

    public function sayHello(Request $request)
    {
        $name = $request->get['name'];

        return new Response(0, 'hello:' . $name, 'ok');
    }


}