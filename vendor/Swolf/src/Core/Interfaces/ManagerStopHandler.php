<?php

namespace Swolf\Core\Interfaces;

use Swoole\Server;

interface ManagerStopHandler
{
    public function onManagerStop(Server $server);
}