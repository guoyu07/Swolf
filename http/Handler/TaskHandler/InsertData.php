<?php
namespace App\Handler\TaskHandler;

use Swolf\Interfaces\TaskHandler;
use Swoole\Server;
use Swolf\Container\Container;

class InsertData implements TaskHandler
{
    public function onTask(Server $serv, $task_id, $src_worker_id, $data)
    {
        /**
         * @var \PDO $db
         */
        $db = Container::get('db');

        $stmt = $db->prepare('INSERT INTO user (name,age) VALUES (?,?)');
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $age);
        foreach ($data as $user) {
            list($name, $age) = [$user->name, $user->age];
            $stmt->execute();
        }

        //在onTask回调函数中调用过finish方法后，return数据依然会触发onFinish事件
        //在onTask回调函数中return字符串，等同于调用finish
        $serv->finish('ok');
    }
}
