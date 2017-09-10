<?php

namespace Swolf\Server\Traits;

use Swolf\Interfaces\PacketHandler;

trait SetPacketHandler
{

    public function setPacketHandler(PacketHandler $packetHandler)
{
    $this->server->on('Packet', [$packetHandler, 'onPacket']);
}
}