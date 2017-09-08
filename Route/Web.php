<?php

use Swolf\Router\Router;

Router::get('/', function () {
    return 'hello world';
});