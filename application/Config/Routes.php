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

    public static $post = [
        '/index' => 'App\\Controller\\Hello@sayHello'
    ];


    public static $put = [];

    public static $head = [];

    public static $options = [];


    public static $group = [
        ['method' => ['GET', 'POST'], 'path' => '/index', 'action' => 'App\\Controller\\Hello@sayHello'],
    ];


}