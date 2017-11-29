<?php

namespace App\Process;

use Swolf\Core\Container\Resource;
use Swolf\Core\Server\Process;
use Swoole\Process as SwooleProcess;
use Swolf\Core\Container\IO;

class Monitor implements Process
{
    public function execute(SwooleProcess $process)
    {
        while (true) {
            $info = Resource::$server->stats();
            IO::output()->table([array_keys($info), array_values($info)], 'Server status');
//            IO::output()->info(json_encode($info));
            sleep(20);
        }
    }
}