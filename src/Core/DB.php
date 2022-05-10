<?php

namespace Core;

class DB {
    private static \PDO $instance;

    private function __construct()
    {}

    public static function getInstance(): \PDO
    {
        if (empty(self::$instance)) {
            $dbConfig = App::getConfig()['db'];

            $opt = [
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['db_name']};charset={$dbConfig['charset']}";

            self::$instance = new \PDO($dsn, $dbConfig['user'], $dbConfig['pass'], $opt);
        }

        return self::$instance;
    }
}