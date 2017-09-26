<?php

namespace Swolf\Core\Server;

use Swolf\Container\Resource;
use Swoole\Http\Server as SwooleHttpServer;
use Swolf\Interfaces\RequestHandler;

class HttpServer extends BasicServer
{

    public function __construct($host, $port)
    {
        $this->server = new SwooleHttpServer($host, $port);
        Resource::$server = &$this->server;
    }

    public function setRequestHandler(RequestHandler $requestHandler)
    {
        $this->server->on('Request', [$requestHandler, 'onRequest']);
    }

    public function run()
    {
        $this->server->start();
    }

}
