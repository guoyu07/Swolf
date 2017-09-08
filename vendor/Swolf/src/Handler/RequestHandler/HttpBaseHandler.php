<?php

namespace Swolf\Handler\RequestHandler;

use Swolf\Interfaces\RequestHandler;
use Swoole\Http\Request;
use Swoole\Http\Response;

class HttpBaseHandler implements RequestHandler
{
    public function onRequest(Request $request, Response $response)
    {
        //dummy method.
    }

    protected function response(Response $resp, $data)
    {
        $resp->end($data);
    }
}