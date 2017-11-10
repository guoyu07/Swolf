<?php

namespace App\Handler\WorkerStartHandler;

use Swolf\Core\Interfaces\WorkerStartHandler;
use App\Config\Database;
use Swolf\Core\Container\Resource;
use Swoole\Server;

class InitDatabaseConnection implements WorkerStartHandler
{
    public function onWorkerStart(Server $server, $worker_id)
    {
        //初始化数据库连接,并注册至资源容器中
        $dsn = sprintf('mysql:host=%s;dbname=%s', Database::$db['host'], Database::$db['database']);
        $pdo = new \PDO(
            $dsn,
            Database::$db['username'],
            Database::$db['password']
        );
        Resource::register('db', $pdo);
    }
}