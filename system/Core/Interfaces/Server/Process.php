<?php


namespace Swolf\Core\Interfaces\Server;

use Swoole\Process as SwooleProcess;

interface Process
{
    public function process(SwooleProcess $process);
}