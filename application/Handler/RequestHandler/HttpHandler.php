<?php

namespace App\Handler\RequestHandler;

use Swolf\Core\Interfaces\RequestHandler;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swolf\Handler\RequestHandler\HttpBaseHandler;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;


class HttpHandler extends HttpBaseHandler implements RequestHandler
{

    public function onRequest(Request $request, Response $response)
    {
        try {
            $token = (new Parser())->parse($request->server['token']);
            $data = new ValidationData();
            $data->setId(123);
            $token->validate($data);
        } catch (\Exception $e) {
            $response->status(500);
            $response->end($e->getMessage());
            return;
        }
        $response->end("hello world");
    }
}