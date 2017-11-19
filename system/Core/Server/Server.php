<?php
/**
 * Created by PhpStorm.
 * User: diki
 * Date: 17-11-20
 * Time: 上午12:49
 */

namespace Swolf\Core\Server;

use Swolf\Core\Interfaces\Server\Process;
use Swoole\Process as SwooleProcess;
use Swolf\Core\Interfaces\Server\Handler;


class Server
{

    /**
     * @var \Swoole\Server;
     */
    private $server;


    public function __construct($server)
    {
        $this->server = $server;
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


}