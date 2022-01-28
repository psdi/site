<?php

namespace Site;

use Michelf\MarkdownExtra;

class PostHandler
{
    public static $_titles = [];

    public static function handle(
        string $year = null,
        string $month = null,
        string $name = null
    ) : void {
        $post = self::findPost($year, $month, $name);

        // render (todo: render in template)
        echo $post['content'];
    }

    private static function findPost(
        string $year = null,
        string $month = null,
        string $name = null
    ) {
        // Get post names
        $titles = self::getPostTitles();

        foreach ($titles as $i => $title) {
            if (false !== strpos($title, "$year-$month") && false !== strpos($title, "{$name}.md")) {
                return self::getPosts($i + 1, 1)[0];
            }
        }

        return false;
    }

    private static function getPosts($page = 1, $perPage = 0)
    {
        if ($perPage === 0) {
            $perPage = 5;
        }

        $titles = self::getPostTitles();
        $titles = array_slice($titles, ($page - 1) * $perPage, $perPage);
        $tmp = [];

        foreach ($titles as $i => $title) {
            $post = [];
            $parts = explode('_', $title);

            $post['date'] = strtotime(str_replace('posts/', '', $parts[0]));
            $post['url'] = '/post' . date('Y/m', $post['date']) . '/' . str_replace('.md', '', $parts[1]);
            $post['content'] = MarkdownExtra::defaultTransform(file_get_contents($title));

            $tmp[] = $post;
        }

        return $tmp;
    }

    private static function getPostTitles()
    {
        if (!self::$_titles) {
            self::$_titles = array_reverse(glob('posts/*.md'));
        }

        return self::$_titles;
    }
}
