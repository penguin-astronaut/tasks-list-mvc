<?php

namespace Core;

class Migration
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = \Core\DB::getInstance();
    }

    public function migrate()
    {
        $files = $this->getMigrationsFiles();

        if (!$files) {
            echo 'nothing to migrate';
            return;
        }

        foreach ($files as $file) {
            $baseName = basename($file);
            $this->db->exec(file_get_contents($file));
            $this->db->query("INSERT INTO `migrations` SET name='$baseName'");
            echo "migration $file complete\n";
        }
    }

    private function getMigrationsFiles(): array
    {
        $sqlFolder = str_replace('\\', '/', __DIR__ . '/../migrations/');
        $allFiles = glob($sqlFolder . '*.sql');
        $data = $this->db->query('SHOW TABLES LIKE "migrations"')->fetchAll();

        if (!$data) {
            return $allFiles;
        }

        $res = $this->db->query("SELECT name FROM `migrations`");
        $names = $res->fetchAll(\PDO::FETCH_COLUMN, 0);

        return array_filter($allFiles, fn($file) => !in_array(basename($file), $names));
    }
}