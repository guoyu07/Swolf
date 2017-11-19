<?php
/**
 * Created by PhpStorm.
 * User: diki
 * Date: 17-11-19
 * Time: 下午11:56
 */

namespace Swolf\Serialization;


use Swolf\Core\Interfaces\Serialization\Serialization;

class Json implements Serialization
{
    /**
     * @param mixed $data
     * @return string
     */
    public function serialize($data): string
    {
        return json_encode($data);
    }


    public function unserialize($data)
    {
        return json_decode($data);
    }
}