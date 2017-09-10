<?php

namespace Swolf\Server;

use Swolf\Container\Resource;
use Swoole\Server as SwooleServer;
use Swolf\Interfaces\WorkerStopHandler;
use Swolf\Interfaces\WorkerStartHandler;
use Swolf\Interfaces\WorkerErrorHandler;
use Swolf\Interfaces\TimerHandler;
use Swolf\Interfaces\TaskHandler;
use Swolf\Interfaces\TaskFinishHandler;
use Swolf\Interfaces\StartHandler;
use Swolf\Interfaces\ShutdownHandler;
use Swolf\Interfaces\Process;
use Swoole\Process as SwooleProcess;
use Swolf\Interfaces\BufferEmptyHandler;
use Swolf\Interfaces\BufferFullHandler;
use Swolf\Interfaces\CloseHandler;
use Swolf\Interfaces\ConnectHandler;
use Swolf\Interfaces\ManagerStartHandler;
use Swolf\Interfaces\ManagerStopHandler;
use Swolf\Interfaces\PacketHandler;
use Swolf\Interfaces\PipeMessageHandler;
use Swolf\Interfaces\ReceiveHandler;

class Server
{
    public function __construct($host, $port, $mode = SWOOLE_PROCESS, $sock_type = SWOOLE_SOCK_TCP)
    {
        $this->server = new SwooleServer($host, $port, $mode, $sock_type);
        Resource::$server = &$this->server;
    }

    public function addProcess(Process $processor)
    {
        $processor = new SwooleProcess([$processor, 'process']);
        $this->server->addProcess($processor);
    }

    public function setBufferEmptyHandler(BufferEmptyHandler $bufferEmptyHandler)
    {
        $this->server->on('BufferEmpty', [$bufferEmptyHandler, 'onBufferEmpty']);
    }

    public function setBufferFullHandler(BufferFullHandler $bufferFullHandler)
    {
        $this->server->on('bufferFull', [$bufferFullHandler, 'onBufferFull']);
    }

    public function setCloseHandler(CloseHandler $closeHandler)
    {
        $this->server->on('close', [$closeHandler, 'onClose']);
    }

    public function setConnectHandler(ConnectHandler $connectHandler)
    {
        $this->server->on('Connect', [$connectHandler, 'onConnect']);
    }

    public function setManagerStartHandler(ManagerStartHandler $managerStartHandler)
    {
        $this->server->on('ManagerStart', [$managerStartHandler, 'onManagerStart']);
    }

    public function setManagerStopHandler(ManagerStopHandler $managerStopHandler)
    {
        $this->server->on('ManagerStop', [$managerStopHandler, 'onManagerStop']);
    }

    public function setPacketHandler(PacketHandler $packetHandler)
    {
        $this->server->on('Packet', [$packetHandler, 'onPacket']);
    }


    public function setPipeMessageHandler(PipeMessageHandler $pipeMessageHandler)
    {
        $this->server->on('PipeMessage', [$pipeMessageHandler, 'onPipeMessage']);
    }

    public function setReceiveHandler(ReceiveHandler $receiveHandler)
    {
        $this->server->on('Receive', [$receiveHandler, 'onReceive']);
    }

    public function setShutdownHandler(ShutdownHandler $shutdownHandler)
    {
        $this->server->on('Shutdown', [$shutdownHandler, 'onShutdown']);
    }

    public function setStartHandler(StartHandler $startHandler)
    {
        $this->server->on('Start', [$startHandler, 'onStart']);
    }

    public function setTaskFinishHandler(TaskFinishHandler $taskFinishHandler)
    {
        $this->server->on('TaskFinish', [$taskFinishHandler, 'onTaskFinish']);
    }

    public function setTaskHandler(TaskHandler $taskHandler)
    {
        $this->server->on('Task', [$taskHandler, 'onTask']);
    }

    public function setTimerHandler(TimerHandler $timerHandler)
    {
        $this->server->on('Timer', [$timerHandler, 'onTimer']);
    }

    public function setWorkerErrorHandler(WorkerErrorHandler $workerErrorHandler)
    {
        $this->server->on('WorkerError', [$workerErrorHandler, 'onWorkerError']);
    }

    public function setWorkerStartHandler(WorkerStartHandler $workerStartHandler)
    {
        $this->server->on('WorkerStart', [$workerStartHandler, 'onWorkerStart']);
    }

    public function setWorkerStopHandler(WorkerStopHandler $workerStopHandler)
    {
        $this->server->on('WorkerStop', [$workerStopHandler, 'onWorkerStop']);
    }

    public function run()
    {
        $this->server->start();
    }


}

