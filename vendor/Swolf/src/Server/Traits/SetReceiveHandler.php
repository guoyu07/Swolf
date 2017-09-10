<?php

namespace Swolf\Server\Traits;

use Swolf\Interfaces\ReceiveHandler;

trait SetReceiveHandler
{
    public function setReceiveHandler(ReceiveHandler $receiveHandler)
    {
        $this->server->on('Receive', [$receiveHandler, 'onReceive']);
    }
}