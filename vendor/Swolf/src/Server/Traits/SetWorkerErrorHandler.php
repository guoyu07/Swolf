<?php
namespace Swolf\Server\Traits;

use Swolf\Interfaces\WorkerErrorHandler;

trait SetWorkerErrorHandler
{
    public function setWorkerErrorHandler(WorkerErrorHandler $workerErrorHandler)
    {
        $this->server->on('WorkerError', [$workerErrorHandler, 'onWorkerError']);
    }
}