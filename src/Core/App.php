<?php

namespace Core;

class App {
    private static array $config;
    public static \PDO $db;

    public function __construct()
    {
        self::$config = require __DIR__ . '/../../config.php';
        self::$db = DB::getInstance();
    }

    public function run()
    {
        session_start();

        $router = new Router();
        $router->goToPage(strtok($_SERVER['REQUEST_URI'], '?'));
    }

    public static function getConfig(): array
    {
        return self::$config;
    }
}