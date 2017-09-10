<?php

namespace Swolf\Server\Traits;

use Swolf\Interfaces\BufferEmptyHandler;

trait SetBufferEmptyHandler
{
    public function setBufferEmptyHandler(BufferEmptyHandler $bufferEmptyHandler)
    {
        $this->server->on('BufferEmpty', [$bufferEmptyHandler, 'onBufferEmpty']);
    }
}