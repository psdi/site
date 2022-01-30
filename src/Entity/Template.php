<?php

namespace Site\Entity;

class Template
{
    private $vars = [];

    public function getVar(string $name, $default = null)
    {
        return $this->vars[$name] ?? $default;
    }

    public function setVar(string $name, $value)
    {
        $this->vars[$name] = $value;
    }

    public function render($view_file)
    {
        if (array_key_exists('view_file', $this->vars)) {
            throw new \Exception('Cannot bind variable called \'view_file\'');
        }

        extract($this->vars);
        ob_start();
        include($view_file);
        return ob_get_clean();
    }
}
