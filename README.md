# Swolf

make swoole more elegant.


# Usage

### basic tcp server

```php

$app = new BasicServer($host, $port, SWOOLE_PROCESS, SWOOLE_SOCK_TCP);

$app->setWorkerStartHandler(new InitDatabaseConnection());

$app->setReceiveHandler(new EchoMsg());

$app->addProcess(new Monitor());

echo 'TCP server is running at ' . $host . ':' . $port . "\n";

$app->run();

```


### http server
```php

$app = new HttpServer('0.0.0.0', 9501);

$app->setWorkerStartHandler(new InitDatabaseConnection());

$app->setRequestHandler(new HttpHandler());

$app->addProcess(new Monitor());

echo 'HTTP server is running at ' . $host . ':' . $port . "\n";

$app->run();

```

### websocket server
```php

$app = new WebsocketServer($host, $port);

$app->setWorkerStartHandler(new InitDatabaseConnection());

//if requesthandler is set, the server can also provide http service.
$app->setRequestHandler(new HttpHandler());

//must set messagehandler
$app->setMessageHandler(new EchoFrame());

$app->addProcess(new Monitor());

echo 'WebSocket server is running at ' . $host . ':' . $port . "\n";

$app->run();

```

# Document
[中文文档](https://chenqinghe.gitbooks.io/swolf)
if you like, you can translate it in other languages :).


# license
the project is under the [MIT](https://github.com/php-swolf/Swolf/blob/master/LICENSE) license.

