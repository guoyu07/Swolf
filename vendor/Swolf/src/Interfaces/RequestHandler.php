<?php

namespace Swolf\Interfaces;


use Swoole\Http\Response;
use Swoole\Http\Request;

interface RequestHandler
{
    public function onRequest(Request $request, Response $response);
}

