<?php
namespace Swolf\Interfaces;


use Swoole\Server;

interface ShutdownHandler
{
    public function onShutdown(Server $server);
}

