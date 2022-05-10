<?php

namespace Core;

class App {
    public static \PDO $db;

    public function __construct()
    {
        self::$db = DB::getInstance();
    }

    public function run()
    {
        session_start();

        $router = new Router();
        $router->goToPage(strtok($_SERVER['REQUEST_URI'], '?'));
    }
}