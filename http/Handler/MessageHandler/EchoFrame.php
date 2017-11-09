<?php

namespace App\Handler\MessageHandler;

use Swolf\Core\Interfaces\MessageHandler;
use Swoole\Server;
use Swoole\WebSocket\Frame;

class EchoFrame implements MessageHandler
{

    public function onMessage(Server $server, Frame $frame)
    {
        echo $frame->data;
    }
}