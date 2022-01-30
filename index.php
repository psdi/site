<?php

require __DIR__ . '/vendor/autoload.php';

use Bramus\Router\Router;
use Site\Entity\Template;

$router = new Router();

$router->get('/home', function () {
    $template = new Template();
    $template->setVar('title', 'stuff');
    $template->setVar('content', $template->render('templates/home.php'));

    echo $template->render('templates/base.php');
});

$router->get('/about-me', function () {
    $template = new Template();
    $template->setVar('title', 'About Me');
    $template->setVar('content', $template->render('templates/about-me.php'));

    echo $template->render('templates/base.php');
});

$router->get('/post/(\d+)/(\d+)/(.+)', '\Site\Handler\PostHandler@handle');

$router->run();
