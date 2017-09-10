<?php

namespace Swolf\Server\Traits;

use Swolf\Interfaces\RequestHandler;

trait SetRequestHandler
{
    public function setRequestHandler(RequestHandler $requestHandler)
    {
        $this->server->on('Request', [$requestHandler, 'onRequest']);
    }
}