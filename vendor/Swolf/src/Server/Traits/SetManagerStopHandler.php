<?php
namespace Swolf\Server\Traits;

use Swolf\Interfaces\ManagerStopHandler;

trait SetManagerStopHandler
{
    public function setManagerStopHandler(ManagerStopHandler $managerStopHandler)
    {
        $this->server->on('ManagerStop', [$managerStopHandler, 'onManagerStop']);
    }

}