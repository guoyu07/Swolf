<?php
/**
 * @Description:
 * @Author: chenqinghe
 * @Date: 2017/11/13
 * @Time: 16:50
 */

namespace App\Config;

use Swolf\Config\Middleware as MiddlewareInterface;

class Middleware implements MiddlewareInterface
{

    public static function getMiddlewares()
    {
        return [
            \App\Middleware\JwtAuth::class,
            \App\Middleware\FaviconFilter::class,
        ];
    }

}