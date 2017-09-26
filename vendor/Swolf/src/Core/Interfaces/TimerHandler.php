<?php
namespace Swolf\Core\Interfaces;

use Swoole\Server;

interface TimerHandler
{

    /**
     * @param Server $server
     * @param int $interval
     * @return mixed
     */
    public function onTimer(Server $server, $interval);

}