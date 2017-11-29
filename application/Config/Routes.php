<?php
/**
 * @Description:
 * @Author: chenqinghe
 * @Date: 2017/11/16
 * @Time: 19:31
 */

namespace App\Config;


use \Swolf\Config\Routers as RoutesInterface;

class Routes implements RoutesInterface
{

    public static function getRouters()
    {
        return [
            ['method' => 'post', 'path' => '/index', 'action' => '\\App\\Service\\Hello@sayHello'],
        ];
    }

}