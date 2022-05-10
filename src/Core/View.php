<?php

namespace Core;

class View
{
    const VIEWS_DIR = __DIR__ . '/../views/';

    public static function render(string $name)
    {
        $content = file_get_contents(self::VIEWS_DIR . $name . '.php');

        require self::VIEWS_DIR . 'base.php';
    }
}