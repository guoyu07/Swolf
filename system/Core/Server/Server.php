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

use Swoole\Process as SwooleProcess;
use Swoole\Server as SwooleServer;
use Swolf\Core\Container\Server as ServerContainer;


class Server
{

    /**
     * @var \Swoole\Server;
     */
    private $server;


    public function __construct(SwooleServer $server)
    {
        $this->server = $server;
        ServerContainer::register($this->server);
    }


    public function addProcess(Process $processor)
    {
        $processor = new SwooleProcess([$processor, 'process']);
        $this->server->addProcess($processor);
    }


    public function setHandler(Handler $handler)
    {
        $hanlerFunc = $handler->handleFunc();
        $hanlerFunc($this->server);
    }


    public function init(array $setting)
    {
        $this->server->set($setting);
    }

    public function run()
    {
        $this->server->start();
    }


    public function __call($name, $arguments)
    {
        call_user_func_array([$this->server, $name], $arguments);
    }


}