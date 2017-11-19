<?php
/**
 * Created by PhpStorm.
 * User: diki
 * Date: 17-11-19
 * Time: 下午11:55
 */

namespace Swolf\Core\Interfaces\Serialization;

interface Serialization
{

    public function serialize(mixed $data): string;


    public function unserialize($data): mixed;


}