<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Swolf\Server\BasicServer;
use Swolf\Command\Parser;
use App\Process\Monitor;
use App\Handler\WorkerStartHandler\InitDatabaseConnection;
use App\Handler\ReceiveHandler\EchoMsg;

$command = new Parser();
$host = &$command->String('host', Parser::PROVIDE_MUST, '0.0.0.0', 'the host listen to');
$port = &$command->Int('port', Parser::PROVIDE_MUST, '9501', 'the port listen to');
$command->Parse();


$app = new BasicServer($host, $port, SWOOLE_PROCESS, SWOOLE_SOCK_TCP);

$app->setWorkerStartHandler(new InitDatabaseConnection());

$app->setReceiveHandler(new EchoMsg());

$app->addProcess(new Monitor());

echo 'TCP server is running at ' . $host . ':' . $port . "\n";

$app->run();