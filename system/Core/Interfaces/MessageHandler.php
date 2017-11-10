<?php

namespace Swolf\Core\Interfaces;


use Swoole\Server;
use Swoole\WebSocket\Frame;

interface MessageHandler
{
    public function onMessage(Server $server, Frame $frame);
}