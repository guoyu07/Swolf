<?php

namespace Swolf\Core\Interfaces;

use Swoole\Server;

interface TaskFinishHandler
{
    /**
     * 当worker进程投递的任务在task_worker中完成时
     * task进程会通过Swoole\Server->finish()方法将任务处理的结果发送给worker进程。
     *
     * @param Server $serv
     * @param int $task_id
     * @param mixed $data
     * @return mixed
     */
    public function onTaskFinish(Server $serv, $task_id, $data);
}

