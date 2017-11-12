<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Config\Handler;
use App\Config\Server;
use App\Config\Process;
use Swolf\Core\Server\HttpServer;
use Swolf\Core\Server\WebsocketServer;
use Swolf\Core\Server\BasicServer;

if (function_exists('cli_set_process_title')) {
    cli_set_process_title(Server::$setting['app_name']);
} else {
    swoole_set_process_name(Server::$setting['app_name']);
}

empty($host) && $host = Server::$setting['host'];
empty($port) && $port = Server::$setting['port'];


switch (Server::$serverType) {
    case Server::TCP_SERVER:
        $app = new BasicServer($host, $port, SWOOLE_PROCESS, SWOOLE_SOCK_TCP);
        break;
    case Server::UDP_SERVER:
        $app = new BasicServer($host, $port, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);
        break;
    case Server::WEBSOCKET_SERVER:
        $app = new WebsocketServer($host, $port);
        break;
    default:
        $app = new HttpServer($host, $port);
}

$app->init(Server::$setting);

foreach (Handler::$handler as $k => $v) {
    echo $v . ' handler set successfully' . "\n";
    $handler = new $v;
    call_user_func_array([$app, 'set' . $k], [$handler]);
}

foreach (Process::$process as $v) {
    echo $v . ' process start.' . "\n";
    $p = new $v;
    $app->addProcess($p);
}

printf("\n\n");
printf("server is running at %s:%d\n", $host, $port);

$app->run();

