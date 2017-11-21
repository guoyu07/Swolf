<?php
/**
 * Created by PhpStorm.
 * User: diki
 * Date: 17-11-20
 * Time: 上午12:26
 */

namespace Swolf\Core\Interfaces\Server;

interface Handler
{

    const WorkerStart =  1;
    const BufferEmpty =  2;
    const BufferFull =   3;
    const Close =        4;
    const Connect =      5;
    const ManagerStart = 6;
    const ManagerStop =  7;
    const Message =      8;
    const Packet =       9;
    const PipeMessage = 10;
    const Receive =     11;
    const Request =     12;
    const Shutdown =    13;
    const Start =       14;
    const TaskFinish =  15;
    const Task =        16;
    const Timer =       17;
    const WorkerError = 18;
    const WorkerStop =  19;


    public function handlerType(): int;

    public function handleFunc(): callable;
}
