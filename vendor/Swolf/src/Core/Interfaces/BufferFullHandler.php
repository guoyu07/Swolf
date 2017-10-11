<?php
/**
 * @Description:
 * @Author: diki
 * @Date: 2017/9/9
 * @Time: 19:52
 */

namespace Swolf\Core\Interfaces;

use Swoole\Server;

interface BufferFullHandler
{
    /**
     * @param Server $server
     * @param int $fd
     * @return mixed
     */
    public function onBufferFull(Server $server, $fd);
}