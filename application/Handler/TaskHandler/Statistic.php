<?php
/**
 * @Description:
 * @Author: chenqinghe
 * @Date: 2017/11/10
 * @Time: 15:51
 */

namespace App\Handler\TaskHandler;

use Swolf\Core\Interfaces\TaskHandler;
use Swoole\Server;

class Statistic implements TaskHandler
{
    public function onTask(Server $serv, $task_id, $src_worker_id, $data)
    {

    }

}