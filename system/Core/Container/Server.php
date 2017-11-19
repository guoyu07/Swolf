<?php
/**
 * @Description:
 * @Author: chenqinghe
 * @Date: 2017/11/10
 * @Time: 12:59
 */

namespace Swolf\Core\Container;

class Server
{
    /**
     * @var \Swolf\Core\Server\BasicServer
     */
    protected static $instance = null;


    public static function register($server)
    {
        self::$instance = $server;
    }


    public static function task()
    {

    }


    public static function __callStatic($name, $arguments)
    {
        if (is_null(self::$instance)) {
            throw new \Exception('Server instance is null.');
        }
        return call_user_func_array([self::$instance, $name], $arguments);
    }


}