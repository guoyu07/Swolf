<?php

namespace Swolf\Interfaces;

use Swoole\Server;

interface ManagerStopHandler
{
    public function onManagerStop(Server $server);
}