<?php

namespace App\Processor;

use Swolf\Container\Container;
use Swolf\Interfaces\Processor;
use Swoole\Process;

class Monitor implements Processor
{
    public function process(Process $process)
    {
        while (true) {
            $info = Container::$server->stats();
            echo json_encode($info);
            sleep(20);
        }
    }
}