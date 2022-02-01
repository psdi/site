<?php

require __DIR__ . '/vendor/autoload.php';

use Bramus\Router\Router;
use Michelf\MarkdownExtra;
use Site\Entity\Template;

$router = new Router();

$router->get('/', function () {
    $template = new Template();
    $template->setVar('title', 'Home');
    $template->setVar('content', $template->render('templates/home.php'));

    echo $template->render('templates/base.php');
});

$router->get('/blog', function () {
    $template = new Template();
    $template->setVar('title', 'Blog');
    $template->setVar('content', $template->render('templates/blog.php'));

    echo $template->render('templates/base.php');
});

$router->get('/about-me', function () {
    $template = new Template();
    $template->setVar('title', 'About Me');
    $template->setVar('content', MarkdownExtra::defaultTransform(file_get_contents('posts/about-me.md')));
    $template->setVar('styles', ['public/css/about-me.css']);

    echo $template->render('templates/base.php');
});

$router->get('/post/(\d+)/(\d+)/(.+)', '\Site\Handler\PostHandler@handle');

$router->run();
