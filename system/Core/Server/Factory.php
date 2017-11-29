<?php
//MIT License
//
//Copyright (c) 2017 清和
//
//Permission is hereby granted, free of charge, to any person obtaining a copy
//of this software and associated documentation files (the "Software"), to deal
//in the Software without restriction, including without limitation the rights
//to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
//copies of the Software, and to permit persons to whom the Software is
//furnished to do so, subject to the following conditions:
//
//The above copyright notice and this permission notice shall be included in all
//copies or substantial portions of the Software.
//
//THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
//IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
//FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
//AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
//                                           LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
//OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
//SOFTWARE.

namespace Swolf\Core\Server;

use Swoole\Server as SwooleServer;
use Swoole\Http\Server as HttpServer;
use Swoole\WebSocket\Server as WebsocketServer;
use Swolf\Core\Container\Config;

class Factory
{

    private function __construct()
    {
    }


    /**
     * @return Server
     */
    public static function instance()
    {
        $host = Config::get('server.host');
        $port = Config::get('server.port');

        switch (Config::get('server.type')) {
            case 'tcp':
                $server = new SwooleServer($host, $port, SWOOLE_PROCESS, SWOOLE_SOCK_TCP);
                break;
            case 'udp':
                $server = new SwooleServer($host, $port, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);
                break;
            case 'websocket':
                $server = new WebsocketServer($host, $port);
                break;
            default://http
                $server = new HttpServer($host, $port);

        }

        $server->set(Config::get('settings'));

        return new Server($server);

    }


}