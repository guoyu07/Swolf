<?php
/**
 * @Description:
 * @Author: chenchao
 * @Date: 2017/11/10
 * @Time: 15:49
 */

namespace App\Config;

class Process
{

    public static $process = [
        'App\\Process\\Monitor',
        'Swolf\\Process\\FileWatcher'
    ];
}