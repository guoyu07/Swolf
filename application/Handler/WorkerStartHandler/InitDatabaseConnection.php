<?php

namespace App\Handler\WorkerStartHandler;

use Swolf\Core\Server\Handler;
use App\Config\Database;
use Swolf\Core\Container\Resource;
use Swoole\Server;

class InitDatabaseConnection implements Handler
{

    public function handlerType(): int
    {
        return self::WorkerStart;
    }

    public function handleFunc(): callable
    {
        return function (Server &$server) {
            $server->on('workerstart', function (Server $server, $worker_id) {
                //init database connection, and register the connection to resource container.
                $dsn = sprintf('mysql:host=%s;dbname=%s', Database::$db['default']['host'], Database::$db['default']['database']);
                $pdo = new \PDO(
                    $dsn,
                    Database::$db['default']['username'],
                    Database::$db['default']['password']
                );
                Resource::register('db', $pdo);
            });
        };
    }
}