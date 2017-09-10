<?php

namespace Swolf\Server\Traits;


use Swolf\Interfaces\ConnectHandler;

trait SetConnectHander
{
    public function setConnectHandler(ConnectHandler $connectHandler)
    {
        $this->server->on('Connect', [$connectHandler, 'onConnect']);
    }
}