<?php

require_once __DIR__ . '/vendor/autoload.php';

use Swolf\Server\Server;
use Swolf\Server\Command;
use App\Handler\DefaultRequestHandler;
use App\Handler\DefaultTaskHandler;
use App\Handler\DefaultWorkerStartHandler;
use App\Handler\DefaultTaskFinishHandler;
use App\Processor\Monitor;

$command = new Command();
$port = &$command->Int('port', Command::PROVIDE_MUST, '9501', 'the port listen to');
$host = &$command->String('host', Command::PROVIDE_MUST, '0.0.0.0', 'the host listen to');
$command->Parse();


$app = new Server($host, $port);

$app->init(['task_worker_num' => 4]);

$app->setWorkerStartHandler(new DefaultWorkerStartHandler());

$app->setRequestHandler(new DefaultRequestHandler());

$app->setTaskHandler(new DefaultTaskHandler());

$app->setTaskFinishHandler(new DefaultTaskFinishHandler());

$app->addProcessor(new Monitor());


echo 'server is running at ' . $host . ':' . $port . "\n";

$app->run();