<?php
/**
 * @Description:
 * @Author: chenqinghe
 * @Date: 2017/11/16
 * @Time: 19:31
 */

namespace App\Config;

class Routes
{
    public static $get = [
        '/index' => 'App\\Controller\\Hello@sayHello'
    ];

}