<?php
namespace Swolf\Interfaces;


use Swoole\Server;

interface ManagerStartHandler
{
    public function onManagerStart(Server $server);
}

