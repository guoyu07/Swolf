<?php
namespace Swolf\Server\Traits;

use Swolf\Interfaces\PipeMessageHandler;

trait SetPipeMessageHandler
{
    public function setPipeMessageHandler(PipeMessageHandler $pipeMessageHandler)
    {
        $this->server->on('PipeMessage', [$pipeMessageHandler, 'onPipeMessage']);
    }

}