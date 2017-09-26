<?php
namespace App\Process;

use Swolf\Container\Resource;
use Swolf\Interfaces\Process;
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