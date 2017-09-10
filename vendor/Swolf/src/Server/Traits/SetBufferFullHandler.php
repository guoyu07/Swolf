<?php
namespace Swolf\Server\Traits;

use Swolf\Interfaces\BufferFullHandler;

trait SetBufferFullHandler
{
    public function setBufferFullHandler(BufferFullHandler $bufferFullHandler)
    {
        $this->server->on('bufferFull', [$bufferFullHandler, 'onBufferFull']);
    }

}