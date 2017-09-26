<?php
/**
 * @Description:
 * @Author: diki
 * @Date: 2017/9/9
 * @Time: 19:48
 */

namespace Swolf\Interfaces;

use Swoole\Server;

interface CloseHandler
{
    /**
     * @param Server $server
     * @param int $fd
     * @param int $reactor_id
     * @return mixed
     */
    public function onClose(Server $server, $fd, $reactor_id);

}