<?php

namespace Site\Handler;

use DOMDocument;
use Michelf\MarkdownExtra;

class PostHandler
{
    public static $_titles = [];

    public const POSTS_PER_PAGE = 5;

    public static function handle(
        string $year = null,
        string $month = null,
        string $name = null
    ) : array {
        return self::findPost($year, $month, $name);
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

    public static function getPosts($page = 1, $perPage = 0)
    {
        if ($perPage === 0) {
            $perPage = self::POSTS_PER_PAGE;
        }

        $titles = self::getPostTitles();
        $titles = array_slice($titles, ($page - 1) * $perPage, $perPage);
        $tmp = [];

        foreach ($titles as $i => $title) {
            $post = [];
            $parts = explode('_', $title);

            $post['date'] = strtotime(str_replace('posts/', '', $parts[0]));
            $post['url'] = '/post/' . date('Y/m', $post['date']) . '/' . str_replace('.md', '', $parts[1]);
            $content = MarkdownExtra::defaultTransform(file_get_contents($title));

            $post['preview'] = self::getPreview($content);

            $contentParts = explode('</h1>', $content, 2);
            $post['title'] = str_replace('<h1>', '', $contentParts[0]);
            $post['content'] = $contentParts[1];

            $tmp[] = $post;
        }

        return $tmp;
    }

    public static function hasPagination($page = 1)
    {
        $total = count(self::getPostTitles());

        return [
            'prev' => $page > 1,
            'next' => $total > $page * self::POSTS_PER_PAGE,
        ];
    }

    private static function getPreview($content)
    {
        $preview = $content;
        $dom = new DOMDocument();
        $dom->validateOnParse = true;
        $dom->preserveWhiteSpace = false;
        $dom->loadHTML($content);

        $nodes = $dom->getElementsByTagName('body')->item(0)->childNodes;

        // do not consider first header tag
        if (count($nodes) - 1 >= 2) {
            $preview = "";
            // counter (i) shouldn't surpass number of nodes
            for ($i = 0, $elems = 0; $elems < 2 && $i < count($nodes); $i++) {
                $node = $nodes[$i];
                $name = $node->nodeName;
                if ($name === 'h1' || $node->nodeType !== XML_ELEMENT_NODE) {
                    continue;
                };

                $innerHTML = '';
                foreach ($node->childNodes as $child) {
                    $innerHTML .= $node->ownerDocument->saveHTML($child);
                }
                $preview .= sprintf("<%s>%s</%s>", $name, $innerHTML, $name);
                $elems++;
            }
        }

        return utf8_decode($preview);
    }

    private static function getPostTitles()
    {
        if (!self::$_titles) {
            self::$_titles = array_reverse(glob('posts/??*_??*.md'));
        }

        return self::$_titles;
    }
}
