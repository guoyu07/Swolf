<?php
/**
 * @Description:
 * @Author: diki
 * @Date: 2017/9/9
 * @Time: 19:56
 */

namespace Swolf\Core\Interfaces;

use Swoole\Server;

interface BufferEmptyHandler
{
    /**
     * @param Server $server
     * @param int $fd
     * @return mixed
     */
    public function onBufferEmpty(Server $server, $fd);
}