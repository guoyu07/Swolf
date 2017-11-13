<?php
/**
 * @Description:
 * @Author: chenchao
 * @Date: 2017/11/10
 * @Time: 15:13
 */

namespace App\Config;

class Handler
{
    public static $handler = [
        'RequestHandler' => 'App\\Handler\\RequestHandler\\HttpHandler',
        'TaskHandler' => 'App\\Handler\\TaskHandler\\Statistic',
//        'WorkerStartHandler' => 'App\Handler\WorkerStartHandler\\InitDatabaseConnection',
    ];

}