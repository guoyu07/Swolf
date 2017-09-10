<?php

namespace Swolf\Interfaces;


use Swoole\Server;

interface StartHandler
{
    public function onStart(Server $server);
}


