<?php

namespace App\Handler\TaskFinishHandler;

use Swolf\Core\Server\Handler;
use Swoole\Server;

class Log implements Handler
{

    public function handlerType(): int
    {
        return self::TaskFinish;
    }

    public function handleFunc(): callable
    {
        return function (Server &$server) {
            $server->on('finish', function (Server $serv, $task_id, $data) {
                $log_msg = sprintf('task %d finished. result is %s', $task_id, $data);
                @error_log($log_msg, 3, '/tmp/swolf.log');
            });
        };
    }
}