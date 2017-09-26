<?php

namespace Swolf\Interfaces;

use Swoole\Server;

interface TaskHandler
{
    /**
     * 在task_worker进程内被调用。
     * worker进程可以使用Swolf::task()函数向task_worker进程投递新的任务。
     *
     * @param Server $serv
     * @param int $task_id
     * @param int $src_worker_id
     * @param mixed $data
     * @return mixed
     */
    public function onTask(Server $serv, $task_id, $src_worker_id, $data);
}

