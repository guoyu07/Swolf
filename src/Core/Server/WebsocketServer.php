<?php

namespace Swolf\Core\Server;

use Swolf\Core\Interfaces\MessageHandler;
use Swoole\Core\WebSocket\Server;
use Swolf\Core\Container\Resource;
use Swolf\Core\Interfaces\RequestHandler;

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