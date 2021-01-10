<?php

namespace Gufo\Sqlite;

/**
 * SQLite connnection
 */
class SQLite
{
    public static function connect()
    {
        try {
            $pdo = new \PDO("sqlite:" . ANAX_INSTALL_PATH . "/data/db.sqlite");
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $pdo;
    }

    public static function connectMemory()
    {
        try {
            $pdo = new \PDO('sqlite::memory:');
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $pdo;
    }
}
