<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Config\Handler;
use App\Config\Server;
use App\Config\Process;
use Swolf\Core\Server\HttpServer;
use Swolf\Core\Server\WebsocketServer;
use Swolf\Core\Server\BasicServer;
use Swolf\Component\Command\Parser;

$command = new Parser();
$host = &$command->String('host', Parser::PROVIDE_OPTIONAL, '0.0.0.0', 'the host listen to');
$port = &$command->Int('port', Parser::PROVIDE_OPTIONAL, '9501', 'the port listen to');
$command->Parse();
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
    $handler = new $v;
    call_user_func_array([$app, 'set' . $k], [$handler]);
}

foreach (Process::$process as $v) {
    $p = new $v;
    $app->addProcess($p);
}

printf("\n\n");
printf("server is running at %s:%d", $host, $port);

$app->run();

