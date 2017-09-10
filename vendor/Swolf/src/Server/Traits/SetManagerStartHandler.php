<?php
namespace Swolf\Server\Traits;

use Swolf\Interfaces\ManagerStartHandler;

trait SetManagerStartHandler
{
    public function setManagerStartHandler(ManagerStartHandler $managerStartHandler)
    {
        $this->server->on('ManagerStart', [$managerStartHandler, 'onManagerStart']);
    }
}