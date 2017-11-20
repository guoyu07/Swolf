<?php
/**
 * Created by PhpStorm.
 * User: diki
 * Date: 17-11-19
 * Time: 下午11:22
 */

namespace Swolf\Core\Server;

use Swoole\Server as SwooleServer;
use Swoole\Http\Server as HttpServer;
use Swoole\WebSocket\Server as WebsocketServer;
use Swolf\Core\Interfaces\Server\Config\Server as ServerConfig;

class ServerFactory
{

    private function __construct()
    {
    }


    /**
     * @param ServerConfig $serverConfig
     * @return Server
     */
    public static function instance(ServerConfig $serverConfig)
    {
        switch ($serverConfig->getServerType()) {
            case 'tcp':
                $server = new SwooleServer($serverConfig->getHost(), $serverConfig->getPort(), SWOOLE_PROCESS, SWOOLE_SOCK_TCP);
                break;
            case 'udp':
                $server = new SwooleServer($serverConfig->getHost(), $serverConfig->getPort(), SWOOLE_PROCESS, SWOOLE_SOCK_UDP);
                break;
            case 'websocket':
                $server = new WebsocketServer($serverConfig->getHost(), $serverConfig->getPort());
                break;
            default://http
                $server = new HttpServer($serverConfig->getHost(), $serverConfig->getPort());

        }
//        return new Server($server);
        $serverInstance = new Server($server);

        $serverInstance->init($serverConfig->getInitSettings());

        $serverInstance->addProcess();

        $serverInstance->setHandler();

    }


}