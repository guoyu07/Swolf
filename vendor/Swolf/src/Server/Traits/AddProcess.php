<?php

namespace Swolf\Server\Traits;

use Swolf\Interfaces\Process;
use Swoole\Process as SwooleProcess;

trait AddProcess
{
    public function addProcess(Process $processor)
    {
        $processor = new SwooleProcess([$processor, 'process']);
        $this->server->addProcess($processor);
    }

}