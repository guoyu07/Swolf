<?php
namespace Swolf\Core\Interfaces;


use Swoole\Server;

interface ManagerStartHandler
{
    public function onManagerStart(Server $server);
}

