<?php
/**
 * @Description:
 * @Author: chenchao
 * @Date: 2017/11/10
 * @Time: 12:59
 */

namespace Swolf\Core\Container;

class Server
{
    /**
     * @var \Swolf\Core\Server\BasicServer
     */
    public static $instance = null;


    public static function __callStatic($name, $arguments)
    {
        if (is_null(self::$instance)) {
            throw new \Exception('Server instance is null.');
        }
        return call_user_func_array([self::$instance, $name], $arguments);
    }


}