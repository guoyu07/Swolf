# Swolf

framework based on swoole


## feature
- easy to register global variable
- easy router
- clear logic

## usage

```php

$app = new Server('0.0.0.0', 9501);

//$app->init(['task_worker_num' => 4]);

$app->setWorkerStartHandler(new DefaultWorkerStartHandler());

$app->setRequestHandler(new DefaultRequestHandler());

$app->setTaskHandler(new DefaultTaskHandler());

$app->run();

```

## license
the project is under the [MIT](http://git.chenqinghe.com/Qinghe/Swolf/src/master/LICENSE) license.

