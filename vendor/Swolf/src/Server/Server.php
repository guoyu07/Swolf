<?php

namespace Swolf\Server;

use Swolf\Container\Container;
use Swoole\Http\Server as SwooleServer;
use Swolf\Interfaces\RequestHandler;
use Swolf\Interfaces\WorkerStartHandler;
use Swolf\Interfaces\TaskHandler;
use Swolf\Interfaces\TaskFinishHandler;
use Swolf\Interfaces\Processor;
use Swoole\Process;

class Server
{

    //handlers
    private $workerStartHandler = null;
    private $requestHandler = null;
    private $taskHandler = null;
    private $taskFinishHandler = null;


    public function __construct($host, $port)
    {
        Container::$server = new SwooleServer($host, $port);
    }

    public function init(array $config)
    {
        Container::$server->set($config);
    }


    public function setRequestHandler(RequestHandler $handler)
    {
        $this->requestHandler = $handler;
    }


    public function setTaskHandler(TaskHandler $handler)
    {
        $this->taskHandler = $handler;
    }


    public function setTaskFinishHandler(TaskFinishHandler $handler)
    {
        $this->taskFinishHandler = $handler;
    }


    public function setWorkerStartHandler(WorkerStartHandler $handler)
    {
        $this->workerStartHandler = $handler;
    }


    public function addProcessor(Processor $p)
    {
        $processor = new Process([$p, 'process']);
        Container::$server->addProcess($processor);
    }


    public function run()
    {

        if (!is_null($this->workerStartHandler)) {
            Container::$server->on('WorkerStart', [$this->workerStartHandler, 'onWorkerStart']);
        }

        if (!is_null($this->requestHandler)) {
            Container::$server->on('Request', [$this->requestHandler, 'onRequest']);
        }

        if (!is_null($this->taskHandler)) {
            Container::$server->on('Task', [$this->taskHandler, 'onTask']);
        }

        if (!is_null($this->taskFinishHandler)) {
            Container::$server->on('Finish', [$this->taskFinishHandler, 'onTaskFinish']);
        }

        Container::$server->start();
    }


    public static function task($data, $dst_worker_id)
    {
        if (!is_null(Container::$server)) {
            Container::$server->task($data, $dst_worker_id);
            return true;
        }
        return false;
    }


}