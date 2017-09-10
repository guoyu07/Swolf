<?php

namespace Swolf\Server\Traits;

use Swolf\Interfaces\TaskHandler;

trait SetTaskHandler
{

    public function setTaskHandler(TaskHandler $taskHandler)
    {
        $this->server->on('Task', [$taskHandler, 'onTask']);
    }

}