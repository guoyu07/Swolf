<?php

namespace Swolf\Server\Traits;

use Swolf\Interfaces\TaskFinishHandler;

trait SetTaskFinishHandler
{
    public function setTaskFinishHandler(TaskFinishHandler $taskFinishHandler)
    {
        $this->server->on('TaskFinish', [$taskFinishHandler, 'onTaskFinish']);
    }
}