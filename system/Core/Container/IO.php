<?php
/**
 * @Description:
 * @Author: chenchao
 * @Date: 2017/11/16
 * @Time: 16:43
 */

namespace Swolf\Core\Container;
class IO
{
    protected static $input = null;


    protected static $output = null;

    public static function output()
    {
        if (self::$output === null) {
            self::$output = new \Inhere\Console\IO\Output();
        }
        return self::$output;
    }

    public static function input()
    {
        if (self::$input === null) {
            self::$input = new \Inhere\Console\IO\Input();
        }
        return self::$input;
    }

}