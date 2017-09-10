<?php
namespace Swolf\Server\Traits;

use Swolf\Interfaces\StartHandler;

trait SetStartHandler
{

    public function setStartHandler(StartHandler $startHandler)
    {
        $this->server->on('Start', [$startHandler, 'onStart']);
    }

}