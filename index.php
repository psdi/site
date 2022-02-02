<?php

require __DIR__ . '/vendor/autoload.php';

use Bramus\Router\Router;
use Michelf\MarkdownExtra;
use Site\Entity\Template;
use Site\Handler\PostHandler;

$router = new Router();

$router->get('/', function () {
    $template = new Template();
    $template->setVar('title', 'Home');
    $template->setVar('content', $template->render('templates/home.php'));

    echo $template->render('templates/base.php');
});

$router->get('/blog(/\d+)?(/)?', function ($page = null) {
    $page = (int) ($page ?? 1);
    $posts = PostHandler::getPosts($page);
    // todo: 404

    $template = new Template();
    $template->setVar('posts', $posts);
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
