<?php
/**
 * @Description:
 * @Author: chenchao
 * @Date: 2017/11/13
 * @Time: 16:50
 */

namespace App\Config;

class Middleware
{

    public static $http = [
        'App\\Middleware\\FaviconFilter',
        'App\\Middleware\\JwtAuth',
    ];

    public static $tcp = [];

    public static $udp = [];

    public static $websocket = [];


}