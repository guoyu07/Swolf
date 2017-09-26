<?php
namespace Swolf\Interfaces;

use Swoole\Server;

interface WorkerStopHandler
{
    /**
     * @param Server $server
     * @param int $worker_id
     * @return mixed
     */
    public function onWorkerStop(Server $server, $worker_id);
}

