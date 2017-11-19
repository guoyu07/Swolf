<?php
/**
 * Created by PhpStorm.
 * User: diki
 * Date: 17-11-19
 * Time: 下午11:22
 */

namespace Swolf\Core\Server;


use Swolf\Core\Interfaces\Server\Config\Config;

class ServerFactory
{

    private function __construct()
    {
    }


    /**
     * @param $servername
     * @param Config $serverconfig
     * @return Server
     */
    public static function instance(Config $serverconfig)
    {
        $server = new \Swoole\Http\Server('127.0.0.1', 9501);
        return new Server($server);
    }


}