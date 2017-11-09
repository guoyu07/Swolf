<?php

namespace Swolf\Core\Interfaces;

use Swoole\Server;

interface WorkerStartHandler
{

    /**
     * 此事件在worker进程/task进程启动时发生。这里创建的对象可以在进程生命周期内使用
     * 如果想使用swoole_server_reload实现代码重载入，必须在workerStart中require你的业务文件，而不是在文件头部。
     * 在onWorkerStart调用之前已包含的文件，不会重新载入代码。
     *
     * @param Server $server
     * @param int $worker_id
     * @return mixed
     */
    public function onWorkerStart(Server $server, $worker_id);


}

