<?php

namespace Core;

class DB {
    private static \PDO $instance;

    private function __construct()
    {}

    public static function getInstance(): \PDO
    {
        if (empty(self::$instance)) {
            $config = require __DIR__ . '/../../config.php';
            $opt = [
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $dsn = "mysql:host={$config['db']['host']};dbname={$config['db']['db_name']};charset={$config['db']['charset']}";

            self::$instance = new \PDO($dsn, $config['db']['user'], $config['db']['pass'], $opt);
        }

        return self::$instance;
    }
}