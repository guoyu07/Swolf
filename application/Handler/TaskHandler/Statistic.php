<?php
/**
 * @Description:
 * @Author: chenqinghe
 * @Date: 2017/11/10
 * @Time: 15:51
 */

namespace App\Handler\TaskHandler;

use Swolf\Core\Interfaces\Server\Handler;
use Swoole\Server;

class Statistic implements Handler
{

    public function handlerType(): int
    {
        return self::Task;
    }


    public function handleFunc(): callable
    {
        return function (Server &$server) {
            $server->on('task', function (Server $serv, $task_id, $src_worker_id, $data) {
                var_dump($serv, $task_id, $src_worker_id, $data);
            });
        };
    }

}