<?php


namespace Swolf\Core\Server;

use Swoole\Process as SwooleProcess;

interface Process
{
    public function execute(SwooleProcess $process);
}