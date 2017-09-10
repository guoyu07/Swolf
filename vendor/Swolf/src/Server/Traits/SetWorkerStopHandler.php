<?php

namespace Swolf\Server\Traits;

use Swolf\Interfaces\WorkerStopHandler;

trait SetWorkerStopHandler
{
    public function setWorkerStopHandler(WorkerStopHandler $workerStopHandler)
    {
        $this->server->on('WorkerStop', [$workerStopHandler, 'onWorkerStop']);
    }
}