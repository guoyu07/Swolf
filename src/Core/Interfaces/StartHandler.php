<?php

namespace Swolf\Core\Interfaces;


use Swoole\Server;

interface StartHandler
{
    public function onStart(Server $server);
}


