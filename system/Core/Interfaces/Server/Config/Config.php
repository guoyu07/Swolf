<?php
/**
 * Created by PhpStorm.
 * User: diki
 * Date: 17-11-19
 * Time: 下午11:34
 */

namespace Swolf\Core\Interfaces\Server\Config;

interface Config
{


    public function getHandlers(): array;


    public function getServerType(): int;

    public function getVersion(): string;


    public function getPort(): int;


    public function getHost(): string;


}