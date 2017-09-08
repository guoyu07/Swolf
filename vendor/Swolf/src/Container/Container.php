<?php

namespace Swolf\Container;

use Swoole\Http\Server;

class  Container
{


    /**
     * @var null|Server
     */
    public static $server = null;


    private static $Resource = [];


    /**
     * 加载资源
     * 如果已加载同名资源，则返回失败
     *
     * @param $name
     * @param $obj
     * @return bool
     */
    public static function register($name, $obj)
    {
        if (isset(static::$Resource[$name])) {
            return false;
        }
        static::$Resource[$name] = $obj;
        return true;
    }


    /**
     * 释放资源
     * 由于常驻内存，因此需要及时释放不需要的资源
     * 减少内存占用，防止内存泄露
     *
     * @param $name
     */
    public function deregister($name)
    {
        unset(static::$Resource[$name]);
    }

    /**
     * 判断某一资源是否已经加载
     *
     * @param $name
     * @return bool
     */
    public function isRegistered($name)
    {
        return isset(self::$Resource[$name]);
    }


    /**
     * 获取某一资源
     *
     * @param $name
     * @return mixed|null
     */
    public static function get($name)
    {
        return isset(static::$Resource[$name]) ? static::$Resource[$name] : null;
    }


}