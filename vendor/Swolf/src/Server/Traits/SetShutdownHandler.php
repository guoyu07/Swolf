<?php
namespace Swolf\Server\Traits;

use Swolf\Interfaces\ShutdownHandler;

trait SetShutdownHandler
{
    public function setShutdownHandler(ShutdownHandler $shutdownHandler)
    {
        $this->server->on('Shutdown', [$shutdownHandler, 'onShutdown']);
    }
}