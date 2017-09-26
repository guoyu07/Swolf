<?php
namespace Swolf\Interfaces;

use Swoole\Server;

interface PipeMessageHandler
{
    /**
     * @param Server $server
     * @param int $fromWorkerId
     * @param string $message
     * @return mixed
     */
    public function onPipeMessage(Server $server, $fromWorkerId, $message);

}