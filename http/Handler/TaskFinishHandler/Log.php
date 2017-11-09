<?php

namespace App\Handler\TaskFinishHandler;

use Swolf\Core\Interfaces\TaskFinishHandler;
use Swoole\Server;

class Log implements TaskFinishHandler
{

    public function onTaskFinish(Server $serv, $task_id, $data)
    {
        $log_msg = sprintf('task %d finished. result is %s', $task_id, $data);
        @error_log($log_msg, 3, '/tmp/swolf.log');
    }
}