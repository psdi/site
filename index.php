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
    $template->setVar('styles', ['/public/css/home.css']);

    echo $template->render('templates/base.php');
});

$router->get('/blog(/\d+)?(/)?', function ($page = null) {
    $page = (int) ($page ?? 1);
    $posts = PostHandler::getPosts($page);
    // todo: 404

    $template = new Template();
    $template->setVar('posts', $posts);
    $template->setVar('title', 'Blog');
    $template->setVar('pagination', PostHandler::hasPagination($page));
    $template->setVar('page', $page);
    $template->setVar('isPreview', true);
    $template->setVar('content', $template->render('templates/blog.php'));
    $template->setVar('styles', ['/public/css/blog.css']);

    echo $template->render('templates/base.php');
});

$router->get('/about-me', function () {
    $template = new Template();
    $template->setVar('title', 'About Me');
    $template->setVar('content', MarkdownExtra::defaultTransform(file_get_contents('posts/about-me.md')));
    $template->setVar('styles', ['public/css/about-me.css']);

    echo $template->render('templates/base.php');
});

$router->get('/post/(\d+)/(\d+)/(.+)', function ($year, $month, $name) {
    $post = PostHandler::handle($year, $month, $name);

    $template = new Template();
    $template->setVar('title', $post['title']);
    $template->setVar('posts', [$post]);
    $template->setVar('content', $template->render('templates/blog.php'));
    $template->setVar('styles', ['/public/css/blog.css']);

    echo $template->render('templates/base.php');
});

$router->run();
