<?php

namespace Swolf\Interfaces;


use Swoole\Server;
use Swoole\WebSocket\Frame;

interface MessageHandler
{
    public function onMessage(Server $server, Frame $frame);
}