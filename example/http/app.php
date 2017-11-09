<?php

require_once __DIR__ . '/vendor/autoload.php';

use Swolf\Core\Server\HttpServer;
use Swolf\Component\Command\Parser;
use App\Process\Monitor;
use App\Handler\WorkerStartHandler\InitDatabaseConnection;
use App\Handler\RequestHandler\HttpHandler;
use Swolf\Process\FileWatcher;

$command = new Parser();
$host = &$command->String('host', Parser::PROVIDE_MUST, '0.0.0.0', 'the host listen to');
$port = &$command->Int('port', Parser::PROVIDE_MUST, '9501', 'the port listen to');
$command->Parse();


$app = new HttpServer($host, $port);

//reload worker if file changed.
$watcher = new FileWatcher(true);
$watcher->addWatchTarget('Handler');

$app->addProcess($watcher);

$app->setWorkerStartHandler(new InitDatabaseConnection());

$app->setRequestHandler(new HttpHandler());

$app->addProcess(new Monitor());

echo 'server is running at ' . $host . ':' . $port . "\n";

$app->run();