<?php
//MIT License
//
//Copyright (c) 2017 清和
//
//Permission is hereby granted, free of charge, to any person obtaining a copy
//of this software and associated documentation files (the "Software"), to deal
//in the Software without restriction, including without limitation the rights
//to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
//copies of the Software, and to permit persons to whom the Software is
//furnished to do so, subject to the following conditions:
//
//The above copyright notice and this permission notice shall be included in all
//copies or substantial portions of the Software.
//
//THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
//IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
//FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
//AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
//                                           LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
//OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
//SOFTWARE.

require_once __DIR__ . "/vendor/autoload.php";

use Swolf\Core\Container\IO;
use Swolf\Core\Server\Factory;
use Swolf\Core\Container\Config;
use App\Config\Handler;


define('APP_PATH', __DIR__ . '/application/');
define('SYS_PATH', __DIR__ . '/system/');


if (IO::input()->hasOpt('c')) {
    $configFile = IO::input()->getOption('c');
} else {
    $configFile = './app.ini';
}

if (!file_exists($configFile)) {
    IO::output()->error(sprintf("can not find the config file you specified: %s", $configFile), true);
}

$config = parse_ini_file($configFile, true);

Config::setBatch($config);

//overwrite config file.
IO::input()->hasOpt('h') && Config::set('server.host', IO::input()->getOption('h'));
IO::input()->hasOpt('p') && Config::set('server.port', IO::input()->getOption('p'));
IO::input()->hasOpt('d') && Config::set('settings.daemonize', IO::input()->getBoolOpt('d'));

$server = Factory::instance();

//set event handlers
foreach (Handler::getHandlers() as $handler) {
    $server->setHandler(new $handler);
}

if (function_exists('cli_set_process_title')) {
    cli_set_process_title(Config::get('app.app_name'));
} else {
    swoole_set_process_name(Config::get('app.app_name'));
}

//start the server
$server->run();







