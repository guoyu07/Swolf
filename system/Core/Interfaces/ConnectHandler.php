<?php

namespace Swolf\Core\Interfaces;

use Swoole\Server;

interface ConnectHandler
{
    /**
     * @param Server $server
     * @param int $fd 连接标识
     * @param int $from_id reactor线程
     * @return mixed
     */
    public function onConnect(Server $server, $fd, $from_id);

}