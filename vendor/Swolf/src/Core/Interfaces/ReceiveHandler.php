<?php
/**
 * @Description:
 * @Author: diki
 * @Date: 2017/9/9
 * @Time: 19:41
 */
namespace Swolf\Core\Interfaces;

use Swoole\Server;

interface ReceiveHandler
{
    /**
     * @param Server $server
     * @param int $fd
     * @param int $reactor_id
     * @param string $data
     * @return mixed
     */
    public function onReceive(Server $server, $fd, $reactor_id, $data);
}