<?php

namespace Core;

class View
{
    const VIEWS_DIR = __DIR__ . '/../views/';

    public static function render(string $name, array $data = [])
    {
        require self::VIEWS_DIR . '/header.php';
        require self::VIEWS_DIR . $name . '.php';
        require self::VIEWS_DIR . '/footer.php';
    }
}