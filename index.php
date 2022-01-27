<?php

require __DIR__ . '/vendor/autoload.php';

use Bramus\Router\Router;

$router = new Router();

$router->get('/(\w+)?', function ($name = null) {
    $addtl = '';
    if ($name) $addtl = ", $name";
    echo 'Hello' . $addtl;
});

$router->run();
