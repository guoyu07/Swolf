<?php
namespace Swolf\Core\Interfaces;


use Swoole\Server;

interface ShutdownHandler
{
    public function onShutdown(Server $server);
}

