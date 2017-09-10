<?php

namespace Swolf\Server;


use Swolf\Server\Server;

use Swolf\Container\Resource;
use Swolf\Server\Traits\AddProcess;
use Swolf\Server\Traits\SetPipeMessageHandler;
use Swolf\Server\Traits\SetReceiveHandler;
use Swolf\Server\Traits\SetRequestHandler;
use Swolf\Server\Traits\SetTaskHandler;
use Swolf\Server\Traits\SetTaskFinishHandler;
use Swolf\Server\Traits\SetWorkerStartHandler;

class WebsocketServer extends Server
{

    use SetWorkerStartHandler;
    use SetTaskHandler;
    use SetTaskFinishHandler;
    use AddProcess;
    use SetReceiveHandler;
    use SetRequestHandler;
    use SetPipeMessageHandler;

    public function __construct($host, $port)
    {
        $this->server = new Server($host, $port);
        Resource::$server = &$this->server;
    }


    public function run()
    {
        $this->server->start();
    }

}