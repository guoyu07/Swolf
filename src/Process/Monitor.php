<?php

namespace Swolf\Process;

use Swolf\Core\Container\Resource;
use Swolf\Core\Interfaces\Process;
use Swoole\Process as SwooleProcess;

class Monitor implements Process
{
    public function process(SwooleProcess $process)
    {
        while (true) {
            $info = Resource::$server->stats();
            printf("%s\n", json_encode($info));
            sleep(20);
        }
    }
}