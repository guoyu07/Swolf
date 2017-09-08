<?php


namespace Swolf\Interfaces;

use Swoole\Process;

interface Processor
{
    public function process(Process $process);
}