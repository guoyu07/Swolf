<?php


namespace Swolf\Core\Interfaces;

use Swoole\Process as SwooleProcess;

interface Process
{
    public function process(SwooleProcess $process);
}