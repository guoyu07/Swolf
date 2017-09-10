<?php

namespace Swolf\Server\Traits;

use Swolf\Interfaces\WorkerStartHandler;

trait SetWorkerStartHandler
{
    public function setWorkerStartHandler(WorkerStartHandler $workerStartHandler)
    {
        $this->server->on('WorkerStart', [$workerStartHandler, 'onWorkerStart']);
    }
}