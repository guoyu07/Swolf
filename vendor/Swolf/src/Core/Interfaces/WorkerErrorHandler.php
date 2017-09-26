<?php
namespace Swolf\Interfaces;

use Swoole\Server;

interface WorkerErrorHandler
{
    /**
     * @param Server $server
     * @param int $workerId
     * @param int $workerPid
     * @param int $exitCode
     * @param int $signal
     * @return mixed
     */
    public function onWorkerError(Server $server, $workerId, $workerPid, $exitCode, $signal);
}

