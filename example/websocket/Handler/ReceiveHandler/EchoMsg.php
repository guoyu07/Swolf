<?php

namespace App\Handler\ReceiveHandler;

use Swolf\Core\Interfaces\ReceiveHandler;
use Swoole\Server;

class EchoMsg implements ReceiveHandler
{
    public function onReceive(Server $server, $fd, $reactor_id, $data)
    {
        $server->send($fd, $data);
    }
}