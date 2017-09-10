<?php
namespace Swolf\Server\Traits;

use Swolf\Interfaces\CloseHandler;

trait  SetCloseHandler
{
    public function setCloseHandler(CloseHandler $closeHandler)
    {
        $this->server->on('close', [$closeHandler, 'onClose']);
    }
}