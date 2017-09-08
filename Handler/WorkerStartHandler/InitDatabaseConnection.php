<?php

namespace App\Handler\WorkerStartHandler;

use Swolf\Interfaces\WorkerStartHandler;
use App\Config\DatabaseConfig;
use Swolf\Container\Container;
use Swoole\Server;

class InitDatabaseConnection implements WorkerStartHandler
{
    public function onWorkerStart(Server $server, $worker_id)
    {
        //初始化数据库连接,并注册至资源容器中
        $dsn = sprintf('mysql:host=%s;dbname=%s', DatabaseConfig::$db['host'], DatabaseConfig::$db['database']);
        $pdo = new \PDO(
            $dsn,
            DatabaseConfig::$db['username'],
            DatabaseConfig::$db['password']
        );
        Container::register('db', $pdo);
    }
}