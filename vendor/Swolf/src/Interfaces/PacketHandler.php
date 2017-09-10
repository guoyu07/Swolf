<?php
namespace Swolf\Interfaces;

use Swoole\Server;

interface PacketHandler
{
    /**
     * @param Server $server
     * @param string $data
     * @param array $client_info
     * @return mixed
     */
    public function onPacket(Server $server, $data, array $client_info);

}