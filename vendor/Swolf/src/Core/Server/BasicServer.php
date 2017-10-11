<?php

namespace Swolf\Core\Server;

use Swolf\Core\Container\Resource;
use Swoole\Server as SwooleServer;
use Swolf\Core\Interfaces\WorkerStopHandler;
use Swolf\Core\Interfaces\WorkerStartHandler;
use Swolf\Core\Interfaces\WorkerErrorHandler;
use Swolf\Core\Interfaces\TimerHandler;
use Swolf\Core\Interfaces\TaskHandler;
use Swolf\Core\Interfaces\TaskFinishHandler;
use Swolf\Core\Interfaces\StartHandler;
use Swolf\Core\Interfaces\ShutdownHandler;
use Swolf\Core\Interfaces\Process;
use Swoole\Process as SwooleProcess;
use Swolf\Core\Interfaces\BufferEmptyHandler;
use Swolf\Core\Interfaces\BufferFullHandler;
use Swolf\Core\Interfaces\CloseHandler;
use Swolf\Core\Interfaces\ConnectHandler;
use Swolf\Core\Interfaces\ManagerStartHandler;
use Swolf\Core\Interfaces\ManagerStopHandler;
use Swolf\Core\Interfaces\PacketHandler;
use Swolf\Core\Interfaces\PipeMessageHandler;
use Swolf\Core\Interfaces\ReceiveHandler;

class BasicServer
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

