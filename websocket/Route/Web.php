<?php

use Swolf\Component\Router\Router;

Router::get('/', function () {
    return 'hello world';
});