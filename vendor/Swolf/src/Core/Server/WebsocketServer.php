<?php

namespace Swolf\Server;

use Swolf\Interfaces\MessageHandler;
use Swoole\WebSocket\Server;
use Swolf\Container\Resource;
use Swolf\Interfaces\RequestHandler;

class WebsocketServer extends BasicServer
{


    public function __construct($host, $port)
    {
        $this->server = new Server($host, $port);
        Resource::$server = &$this->server;
    }


    public function setRequestHandler(RequestHandler $requestHandler)
    {
        $this->server->on('Request', [$requestHandler, 'onRequest']);
    }

    public function setMessageHandler(MessageHandler $messageHandler)
    {
        $this->server->on('Message', [$messageHandler, 'onMessage']);
    }


    public function run()
    {
        $this->server->start();
    }

}