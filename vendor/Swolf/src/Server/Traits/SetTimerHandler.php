<?php

namespace Swolf\Server\Traits;

use Swolf\Interfaces\TimerHandler;

trait SetTimerHandler
{
    public function setTimerHandler(TimerHandler $timerHandler)
    {
        $this->server->on('Timer', [$timerHandler, 'onTimer']);
    }
}