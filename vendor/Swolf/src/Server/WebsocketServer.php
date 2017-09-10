<?php

namespace Swolf\Server;


use Swolf\Server\Server;
use Swolf\Container\Resource;

class WebsocketServer extends BasicServer
{


    public function __construct($host, $port)
    {
        $this->server = new Server($host, $port);
        Resource::$server = &$this->server;
    }


    public function run()
    {
        $this->server->start();
    }

}