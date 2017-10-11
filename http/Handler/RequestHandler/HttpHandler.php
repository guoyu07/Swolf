<?php
namespace App\Handler\RequestHandler;

use Swolf\Interfaces\RequestHandler;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swolf\Handler\RequestHandler\HttpBaseHandler;

class HttpHandler extends HttpBaseHandler implements RequestHandler
{

    public function onRequest(Request $request, Response $response)
    {
        $response->end("hello world");
    }
}