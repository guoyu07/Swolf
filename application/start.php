<?php
/**
 * Created by PhpStorm.
 * User: diki
 * Date: 17-11-19
 * Time: 下午11:15
 */


use App\Config\Server as ServerConfig;
use Swolf\Core\Server\ServerFactory;


include_once '../vendor/autoload.php';


$serverConfig = new ServerConfig();

$server = ServerFactory::instance($serverConfig);

$server->setHandler();


$server->init();


$server->addProcess();


$server->run();










if (function_exists('cli_set_process_title')) {
    cli_set_process_title(Server::$setting['app_name']);
} else {
    swoole_set_process_name(Server::$setting['app_name']);
}

empty($host) && $host = Server::$setting['host'];
empty($port) && $port = Server::$setting['port'];


switch (Server::$serverType) {
    case Server::TCP_SERVER:
        $server = new BasicServer($host, $port, SWOOLE_PROCESS, SWOOLE_SOCK_TCP);
        break;
    case Server::UDP_SERVER:
        $server = new BasicServer($host, $port, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);
        break;
    case Server::WEBSOCKET_SERVER:
        $server = new WebsocketServer($host, $port);
        break;
    default:
        $server = new HttpServer($host, $port);
}

$server->init(Server::$setting);

foreach (Handler::$handler as $k => $v) {
    $out->info($v . ' set successfully');
    $handler = new $v;
    call_user_func_array([$server, 'set' . $k], [$handler]);
}

foreach (Process::$process as $v) {
    $out->info($v . ' process start');
    $p = new $v;
    $server->addProcess($p);
}

$out->info('server is runnint at ' . $host . ':' . $port);

$server->run();