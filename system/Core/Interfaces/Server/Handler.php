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
    public function handleFunc(): callable;
}